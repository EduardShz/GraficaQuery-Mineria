export function calcularEstadisticas(valores) {
    const arr = valores.map((n) => Number(n)).filter((n) => !isNaN(n));

    // Media
    const media = arr.length
        ? Math.round(arr.reduce((a, b) => a + b, 0) / arr.length)
        : 0;

    // Mediana
    const ordenados = [...arr].sort((a, b) => a - b);
    const mid = Math.floor(ordenados.length / 2);
    const mediana =
        ordenados.length % 2 === 0
            ? Math.round((ordenados[mid - 1] + ordenados[mid]) / 2)
            : ordenados[mid];

    // Moda
    const counts = {};
    arr.forEach((val) => {
        counts[val] = (counts[val] || 0) + 1;
    });
    const max = Math.max(...Object.values(counts));
    const modas = Object.keys(counts)
        .filter((k) => counts[k] === max)
        .map(Number);

    const moda = modas.length > 3 ? [] : modas;

    return {
        media,
        mediana,
        moda,
    };
}
