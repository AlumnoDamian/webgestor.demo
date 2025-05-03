@props(['datetime'])

<span
    x-data="{
        time: '{{ $datetime }}',
        formatTimeAgo(datetime) {
            const date = new Date(datetime);
            const now = new Date();
            const seconds = Math.floor((now - date) / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);

            if (days > 0) {
                return `hace ${days} ${days === 1 ? 'día' : 'días'}`;
            } else if (hours > 0) {
                return `hace ${hours} ${hours === 1 ? 'hora' : 'horas'}`;
            } else if (minutes > 0) {
                return `hace ${minutes} ${minutes === 1 ? 'minuto' : 'minutos'}`;
            } else {
                return 'hace unos segundos';
            }
        }
    }"
    x-init="setInterval(() => $el.textContent = formatTimeAgo(time), 1000)"
    x-text="formatTimeAgo(time)"
></span>
