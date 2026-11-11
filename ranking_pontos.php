<?php
/**
 * Tabelas de pontuação do ranking por quantidade de estrelas do evento.
 *
 * Os valores foram extraídos das antigas tabelas de pontuação por estrelas,
 * que foram substituídas por este arquivo e removidas do projeto.
 *
 * Correções aplicadas nas tabelas de 3 e 4 estrelas para manter a pontuação
 * decrescente conforme a colocação:
 *   - 3 estrelas: colocações 21 a 30 estavam fora de ordem no arquivo antigo.
 *   - 4 estrelas: 19º lugar estava com 763; o correto é 779.
 */

function ranking_tabela_pontos(): array
{
    static $tabelas = null;

    if ($tabelas === null) {
        $tabelas = [
            1 => [
                900, 888, 875, 863, 850, 838, 829, 821, 813, 804,
                796, 788, 779, 771, 763, 754, 746, 738, 729, 721,
                713, 704, 696, 688, 679, 671, 663, 654, 646, 638,
            ],
            2 => [
                925, 913, 900, 888, 875, 863, 850, 838, 829, 821,
                813, 804, 796, 788, 779, 771, 763, 754, 746, 738,
                729, 721, 713, 704, 696, 688, 679, 671, 663, 654,
            ],
            3 => [
                950, 938, 925, 913, 900, 888, 875, 863, 850, 838,
                829, 821, 813, 804, 796, 788, 779, 771, 763, 754,
                746, 738, 729, 721, 713, 704, 696, 688, 679, 671,
            ],
            4 => [
                975, 963, 950, 938, 925, 913, 900, 888, 875, 863,
                850, 838, 829, 821, 813, 804, 796, 788, 779, 771,
                763, 754, 746, 738, 729, 721, 713, 704, 696, 688,
            ],
            5 => [
                1000, 988, 975, 963, 950, 938, 925, 913, 900, 888,
                875, 863, 850, 838, 829, 821, 813, 804, 796, 788,
                779, 771, 763, 754, 746, 738, 729, 721, 713, 704,
            ],
        ];
    }

    return $tabelas;
}

function ranking_pontos_estrela(int $estrelas): array
{
    $tabelas = ranking_tabela_pontos();

    return $tabelas[$estrelas] ?? $tabelas[1];
}

function ranking_pontos_colocacao(int $estrelas, int $colocacao): int
{
    $tabela = ranking_pontos_estrela($estrelas);

    return $tabela[$colocacao - 1] ?? 0;
}
