{{-- 
    Template Name: Eleições 2022
--}}

@extends('layouts.portal')
@section('content')
@while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
@endwhile

    <?php

        // error_reporting(E_ALL);
        // ini_set("display_errors", 1);

        #RESULTADOS PRESIDENTE
        $json_pres = file_get_contents('https://resultados.tse.jus.br/oficial/ele2022/544/dados-simplificados/br/br-c0001-e000544-r.json');
        $obj_pres = json_decode($json_pres);

        $cand = $obj_pres->cand;
        echo '<div class="tudo_1">';
        echo '<div class="sec">';

        $sprdr_pres = ' <div class="separador-secao">
                            <h2>Presidente </h2>
                        </div>';
        echo $sprdr_pres;

        echo '<div class="cnddts">';

        for($i = 0; $i <= 1; $i++){

            $pres_porcentagem = $cand[$i]->pvap;
            $pres_numVotos = number_format($cand[$i]->vap);
            $pres_partido = $cand[$i]->n;
            $pres_nome = $cand[$i]->nm;
            $pres_sigla = explode('-', $cand[$i]->cc)[0];
            $sigla_partido = $pres_sigla.' - '.$pres_partido;

            if($pres_nome == 'LULA'){
                $src_img = './img/lula.jpeg';
            }else{
                $src_img = './img/jair.jpeg';
            }

            if(strpos($pres_nome, ' ') != false){
                $pres_nome = explode(' ', $pres_nome);
                $pres_nome = $pres_nome[0].'<br>'.$pres_nome[1];
            }

            $qdr = '<div class="qdr-cnddt">
                        <div class="bloco-azul">
                            <div class="icon-candidato"><img class="candid" src="'.$src_img.'" alt=""></div>
                            <div class="cnddt-porcentagem">'.$pres_porcentagem.'% </div>
                            <div class="cnddt-votos">'. $pres_numVotos.' votos' . '</div>
                        </div>
                        <div class="bloco-branco">
                            <div class="cnddt-partido">'. $sigla_partido .'</div>
                            <div class="cnddt-nome">'. $pres_nome .'</div>
                        </div>
                    </div>';

            echo $qdr;

        }

        echo '</div>';

        $sprdr_gov = '  <div class="separador-secao">
                            <h2>Governador(a)</h2>
                        </div>';

        echo $sprdr_gov;
        echo '<div class="cnddts">';

        #RESULTADOS GOVERNADOR
        $json_gov = file_get_contents('https://resultados.tse.jus.br/oficial/ele2022/546/dados-simplificados/sp/sp-c0003-e000546-r.json');
        $obj_gov = json_decode($json_gov);

        $cand_gov = $obj_gov->cand;

        for($i = 0; $i <= 9; $i++){

            if($cand_gov[$i]->st == '2º turno'){

                $gov_porcentagem = $cand_gov[$i]->pvap;
                $gov_numVotos = number_format($cand_gov[$i]->vap);
                $gov_partido = $cand_gov[$i]->n;
                $gov_nome = $cand_gov[$i]->nm;
                $gov_sigla = explode('-', $cand_gov[$i]->cc)[0];
                $sigla_partido = $gov_sigla.' - '.$gov_partido;

                if($gov_nome == 'TARCÍSIO'){
                    $img_src = './img/tarcisio.jpg';
                }else{
                    $img_src = './img/haddad.jpg';
                }

                if(strpos($gov_nome, ' ') != false){
                    $gov_nome = explode(' ', $gov_nome);
                    $gov_nome = $gov_nome[0].'<br>'.$gov_nome[1];
                }

                $qdr = '<div class="qdr-cnddt">
                            <div class="bloco-azul">
                                <div class="icon-candidato"><img class="candid" src="'.$img_src.'" alt=""></div>
                                <div class="cnddt-porcentagem">'.$gov_porcentagem.'% </div>
                                <div class="cnddt-votos">'. $gov_numVotos.' votos' . '</div>
                            </div>
                            <div class="bloco-branco">
                                <div class="cnddt-partido">'. $sigla_partido .'</div>
                                <div class="cnddt-nome">'. $gov_nome .'</div>
                            </div>
                        </div>';

                echo $qdr;

            }

        }

        echo '</div>';

        echo '</div>';
        echo '</div>';

    ?>

@endsection
