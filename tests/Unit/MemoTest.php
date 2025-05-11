<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Memo;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class MemoTest extends TestCase
{
    use RefreshDatabase;

    private Memo $memo;
    private Department $department;

    protected function setUp(): void
    {
        parent::setUp();
        $this->department = Department::factory()->create();
        $this->memo = Memo::factory()->create([
            'department_id' => $this->department->id
        ]);
    }

    #[Test]
    public function memo_has_required_attributes()
    {
        $this->assertNotNull($this->memo->title);
        $this->assertNotNull($this->memo->type);
        $this->assertNotNull($this->memo->content);
        $this->assertNotNull($this->memo->department_id);
    }

    #[Test]
    public function memo_belongs_to_department()
    {
        $this->assertInstanceOf(Department::class, $this->memo->department);
        $this->assertEquals($this->department->id, $this->memo->department->id);
    }

    #[Test]
    public function memo_can_be_published()
    {
        $publishDate = now();
        
        $memo = Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => $publishDate
        ]);

        $this->assertEquals($publishDate->format('Y-m-d H:i'), $memo->published_at->format('Y-m-d H:i'));
    }

    #[Test]
    public function memo_can_be_unpublished()
    {
        $memo = Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => now()->addYear() // Fecha futura = no publicado aún
        ]);

        $this->assertTrue($memo->published_at->isFuture());
    }

    #[Test]
    public function memo_can_be_filtered_by_type()
    {
        // Limpiar memos existentes
        Memo::query()->delete();

        // Crear memos de diferentes tipos
        Memo::factory()->count(2)->create([
            'department_id' => $this->department->id,
            'type' => 'Importante'
        ]);

        Memo::factory()->create([
            'department_id' => $this->department->id,
            'type' => 'Urgente'
        ]);

        $importantes = Memo::where('type', 'Importante')->count();
        $urgentes = Memo::where('type', 'Urgente')->count();

        $this->assertEquals(2, $importantes);
        $this->assertEquals(1, $urgentes);
    }

    #[Test]
    public function memo_can_be_filtered_by_date_range()
    {
        // Limpiar memos existentes
        Memo::query()->delete();

        // Crear memos con diferentes fechas de publicación
        Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => now()->subDays(1)
        ]);

        Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => now()->subDays(5)
        ]);

        Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => now()->subDays(10)
        ]);

        $recentMemos = Memo::where('published_at', '>=', now()->subDays(7))->count();
        $this->assertEquals(2, $recentMemos);
    }

    #[Test]
    public function memo_can_be_searched_by_title()
    {
        $searchTitle = 'Reunión importante';
        
        Memo::factory()->create([
            'department_id' => $this->department->id,
            'title' => $searchTitle
        ]);

        $foundMemo = Memo::where('title', 'like', '%Reunión%')->first();
        
        $this->assertNotNull($foundMemo);
        $this->assertEquals($searchTitle, $foundMemo->title);
    }

    #[Test]
    public function memo_can_be_searched_by_content()
    {
        $searchContent = 'Contenido específico para buscar';
        
        Memo::factory()->create([
            'department_id' => $this->department->id,
            'content' => $searchContent
        ]);

        $foundMemo = Memo::where('content', 'like', '%específico%')->first();
        
        $this->assertNotNull($foundMemo);
        $this->assertEquals($searchContent, $foundMemo->content);
    }

    #[Test]
    public function memo_can_be_ordered_by_published_date()
    {
        // Limpiar memos existentes
        Memo::query()->delete();

        // Crear memos con diferentes fechas
        $oldestDate = now()->subDays(5);
        $middleDate = now()->subDays(3);
        $newestDate = now()->subDay();

        Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => $middleDate
        ]);

        $oldest = Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => $oldestDate
        ]);

        $newest = Memo::factory()->create([
            'department_id' => $this->department->id,
            'published_at' => $newestDate
        ]);

        $orderedMemos = Memo::orderBy('published_at', 'desc')->get();

        $this->assertTrue(
            $orderedMemos->first()->published_at->toDateTimeString() === $newestDate->toDateTimeString(),
            "First memo should have the newest date"
        );
        $this->assertTrue(
            $orderedMemos->last()->published_at->toDateTimeString() === $oldestDate->toDateTimeString(),
            "Last memo should have the oldest date"
        );
    }

    #[Test]
    public function memo_can_be_soft_deleted()
    {
        $memo = Memo::factory()->create([
            'department_id' => $this->department->id
        ]);

        $memoId = $memo->id;
        $memo->delete();

        // Verificar que no se puede encontrar con una consulta normal
        $this->assertNull(Memo::find($memoId));
        
        // Verificar que se puede encontrar incluyendo los eliminados
        $this->assertNotNull(Memo::withTrashed()->find($memoId));
    }

    #[Test]
    public function department_can_have_multiple_memos()
    {
        // Limpiar memos existentes
        Memo::query()->delete();

        // Crear memos adicionales para el departamento
        Memo::factory()->count(3)->create([
            'department_id' => $this->department->id
        ]);

        $totalMemos = $this->department->memos()->count();
        
        $this->assertEquals(3, $totalMemos);
    }

    #[Test]
    public function memo_type_must_be_valid()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Memo::factory()->create([
            'department_id' => $this->department->id,
            'type' => 'tipo_invalido'
        ]);
    }
}
