<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gráfica Affinity</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/destaque.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/decoracao.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/evento.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/novidades.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/footer.css?v=2') }}">
    <link rel="stylesheet" href="{{ asset('css/home/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu/menu-mobile.css') }}">


    <link rel="stylesheet" href="{{ asset('css/componentes/efeito_imagem/image.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu/menu.css') }}">

</head>

<body class="antialiased">

    <div class="btn-mobile">
        <span class="fas fa-bars"></span>
    </div>
    <navigation class="sidebar">
        <div class="text">MENU</div>
        <ul>
            @foreach ($prod_categoria as $index => $categoria)
            <li>
                <a href="#" class="{{ ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth'][$index % 8] }}-btn">{{ $categoria->nome }}
                    
                </a>
                <ul class="{{ ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth'][$index % 8] }}-show">
                    @if (!empty($categoria->subcategoria))
                    @foreach ($categoria->subcategoria as $subcategoria)
                    <li><a href="produtos/{{ $subcategoria->id }}">{{ $subcategoria->nome }}</a></li>
                    @endforeach
                    @endif
                
                </ul>
            </li>
            @endforeach
        </ul>
    </navigation>


    <div class="header">
        <div class="">
            <ul class="list-network">
                <li>
                    <a href="https://wa.me/5511940719244" target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                            height="1em" id="icon-whatsapp"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #2fa75b
                                }
                            </style>
                            <path
                                d="M224 122.8c-72.7 0-131.8 59.1-131.9 131.8 0 24.9 7 49.2 20.2 70.1l3.1 5-13.3 48.6 49.9-13.1 4.8 2.9c20.2 12 43.4 18.4 67.1 18.4h.1c72.6 0 133.3-59.1 133.3-131.8 0-35.2-15.2-68.3-40.1-93.2-25-25-58-38.7-93.2-38.7zm77.5 188.4c-3.3 9.3-19.1 17.7-26.7 18.8-12.6 1.9-22.4.9-47.5-9.9-39.7-17.2-65.7-57.2-67.7-59.8-2-2.6-16.2-21.5-16.2-41s10.2-29.1 13.9-33.1c3.6-4 7.9-5 10.6-5 2.6 0 5.3 0 7.6.1 2.4.1 5.7-.9 8.9 6.8 3.3 7.9 11.2 27.4 12.2 29.4s1.7 4.3.3 6.9c-7.6 15.2-15.7 14.6-11.6 21.6 15.3 26.3 30.6 35.4 53.9 47.1 4 2 6.3 1.7 8.6-1 2.3-2.6 9.9-11.6 12.5-15.5 2.6-4 5.3-3.3 8.9-2 3.6 1.3 23.1 10.9 27.1 12.9s6.6 3 7.6 4.6c.9 1.9.9 9.9-2.4 19.1zM400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM223.9 413.2c-26.6 0-52.7-6.7-75.8-19.3L64 416l22.5-82.2c-13.9-24-21.2-51.3-21.2-79.3C65.4 167.1 136.5 96 223.9 96c42.4 0 82.2 16.5 112.2 46.5 29.9 30 47.9 69.8 47.9 112.2 0 87.4-72.7 158.5-160.1 158.5z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/agenciaaffinity/" target="_blank"><svg
                            xmlns="http://www.w3.org/2000/svg" height="1em" id="icon-facebook"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #1146a2
                                }
                            </style>
                            <path
                                d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/agenciaaffinity/" target="_blank"><svg
                            xmlns="http://www.w3.org/2000/svg" height="1em" id="icon-instagram"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #7b4582
                                }
                            </style>
                            <path
                                d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z" />
                        </svg></a>
                </li>
                <li>
                    <a href="https://www.youtube.com/channel/UCV7VU4_HG5Ti2LBAFMJ4wrQ/videos" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" id="icon-youtube"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #4a1226
                                }
                            </style>
                            <path
                                d="M186.8 202.1l95.2 54.1-95.2 54.1V202.1zM448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-42 176.3s0-59.6-7.6-88.2c-4.2-15.8-16.5-28.2-32.2-32.4C337.9 128 224 128 224 128s-113.9 0-142.2 7.7c-15.7 4.2-28 16.6-32.2 32.4-7.6 28.5-7.6 88.2-7.6 88.2s0 59.6 7.6 88.2c4.2 15.8 16.5 27.7 32.2 31.9C110.1 384 224 384 224 384s113.9 0 142.2-7.7c15.7-4.2 28-16.1 32.2-31.9 7.6-28.5 7.6-88.1 7.6-88.1z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/company/affinityagencia" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" id="icon-linkedin"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #5a81c4
                                }
                            </style>
                            <path
                                d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="logo_affinity">
            <img src="{{ asset('image/header/affinity.png') }}">
        </div>
        <div class="box">
            {{-- <input type="checkbox" id="check">
            <div class="search-box">
                <input type="text" placeholder="O que você está procurando? " id="input-search">
                <a href="#" id="btn-search">
                    <label for="check" class="icon">
                        <i class="fas fa-search"></i>
                    </label>
                </a>
            </div> --}}
        </div>
    </div>

    <div class="m-horizontal">
        <ul class="menu-horizontal">
            <!-- Esse é o 1 nivel ou o nivel principal -->
            @foreach ($prod_categoria as $categoria)
                <li><a href="#">{{ $categoria->nome }}</a>

                    <ul class="submenu-horizontal-1">
                        @if (!empty($categoria->subcategoria))
                            @foreach ($categoria->subcategoria as $subcategoria)
                                <li><a href="produtos/{{ $subcategoria->id }}">{{ $subcategoria->nome }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>


    <div class="slider-container">
        <div class="slider-control left inactive"></div>
        <div class="slider-control right"></div>
        <ul class="slider-pagi"></ul>
        <div class="slider">
            <div class="slide slide-0 active">
                <div class="slide__bg"></div>
                <div class="slide__content">
                    <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                    </svg>
                    <div class="slide__text">
                        <h2 class="slide__text-heading">Soluções de Impressão Profissional</h2>
                        <p class="slide__text-desc">Oferecemos uma ampla gama de serviços de impressão de alta
                            qualidade, desde cartões de visita a banners e material promocional.
                        </p>
                    </div>
                </div>
            </div>
            <div class="slide slide-1 ">
                <div class="slide__bg"></div>
                <div class="slide__content">
                    <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                    </svg>
                    <div class="slide__text">
                        <h2 class="slide__text-heading">Transformando Ideias em Realidade Gráfica</h2>
                        <p class="slide__text-desc">"Nossa equipe de especialistas está pronta para atender às suas
                            necessidades de impressão, com designs personalizados e impressões excepcionais que
                            impressionam. </p>
                    </div>
                </div>
            </div>
            <div class="slide slide-2">
                <div class="slide__bg"></div>
                <div class="slide__content">
                    <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                    </svg>
                    <div class="slide__text">
                        <h2 class="slide__text-heading">Qualidade e Criatividade em Cada Impressão</h2>
                        <p class="slide__text-desc">Impressões excepcionais, satisfação do cliente e compromisso com a
                            excelência são os pilares da nossa gráfica.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <slider>
        <div class="slide-container">
            <img id="slide-left" class="arrow" src="{{ asset('image/categoria/arrow-left.png') }}" />
            <section class="container-img" id="slider">


                @foreach ($prod_categoria as $categoria)
                    <div class="thumbnail">
                        <a href="{{ asset('produtos/categoria/' . $categoria['id']) }}"
                            alt="{{ $categoria['nome'] }}">
                            <img src="{{ asset('' . $categoria['url_image']) }}" alt="{{ $categoria['nome'] }}" />
                            <div class="product-details">
                                <span>{!! $categoria['nome'] !!}</span>
                            </div>
                        </a>
                    </div>
                @endforeach


            </section>

            <img id="slide-right" class="arrow" src="{{ asset('image/categoria/arrow-right.png') }}" />
        </div>
    </slider>

    <div class="destaque">
        <div class="title-destaque">
            Destaques
        </div>

        @foreach ($produtos_destaques as $produto)
            <div class="destaque-img-{{ $loop->iteration }} item-destaque">
                <a href="{{ asset('produtos/categoria/' . $produto['categoria_id']) }}"
                    alt="{{ $produto['titulo'] }}">
                    <figure class="c4-izmir c4-border-cc-2 c4-image-zoom-in">
                        <img src="{{ asset('' . $produto['url_image']) }}" alt="{{ $produto['titulo'] }}" />
                        <figcaption>
                            <div class="c4-reveal-up">
                                <h3>
                                    VER MAIS
                                </h3>
                            </div>
                        </figcaption>
                    </figure>
                    <p>{{ $produto['titulo'] }}</p>
                </a>
            </div>
        @endforeach


    </div>


    <div class="decoracao">
        <div class="title-decoracao">
            Decore seu PDV
        </div>

        @foreach ($produtos_decoracao as $produto)
            <div class="decoracao-img-{{ $loop->iteration }} item-destaque">
                <a href="{{ asset('produtos/categoria/' . $produto['categoria_id']) }}"
                    alt="{{ $produto['titulo'] }}">
                    <figure class="c4-izmir c4-border-cc-2 c4-image-zoom-in">
                        <img src="{{ asset('' . $produto['url_image']) }}" alt="{{ $produto['titulo'] }}" />
                        <figcaption>
                            <div class="c4-reveal-up">
                                <h3>
                                    VER MAIS
                                </h3>
                            </div>
                        </figcaption>
                    </figure>

                    <p class="title">{{ $produto['titulo'] }}</p>
                    <p class="subtitle">{{ $produto['titulo'] }}</b>
                </a>
            </div>
        @endforeach

    </div>


    <div class="evento">
        <div class="title-evento">
            Tudo para o seu Evento
        </div>

        @foreach ($produtos_evento as $produto)
            <div class="decoracao-img-{{ $loop->iteration }} item-destaque">
                <a href="{{ asset('produtos/categoria/' . $produto['categoria_id']) }}"
                    alt="{{ $produto['titulo'] }}">
                    <figure class="c4-izmir c4-border-cc-2 c4-image-zoom-in">
                        <img src="{{ asset('' . $produto['url_image']) }}" alt="{{ $produto['titulo'] }}" />
                        <figcaption>
                            <div class="c4-reveal-up">
                                <h3>
                                    VER MAIS
                                </h3>
                            </div>
                        </figcaption>
                    </figure>
                    <p class="title">{{ $produto['titulo'] }}</p>
                    <p class="subtitle">{{ $produto['subtitulo'] }}</b>
                </a>
            </div>
        @endforeach

    </div>

    <div class="novidades">
        <div class="text-novidades">
            <img src="{{ asset('image/novidades/envelope.png') }}" alt="" />
            <div class="texto-novidades">
                <p class="title-novidades">Fique por dentro das novidades!</p>
                <p class="subtitle-novidades">Assine nossa newsletter e fique por dentro!</p>
            </div>
        </div>
        <div class="">
            <form class="form-news">
                <input type="email" name="mail_news" placeholder="Digite aqui o seu e-mail">
                <button type="submit">Inscrever</button>
            </form>
        </div>
    </div>

    <form class="form-contato">
        <footer>

            <div class="footer-endereco">
                <img src="{{ asset('image/footer/logo_affinity.png') }}" alt="" />
                <p class="text-footer">
                    Somos uma empresa dedicada à excelência gráfica, comprometida em fornecer serviços de impressão de
                    alta
                    qualidade e soluções visuais inovadoras. Nossa equipe apaixonada e experiente está aqui para atender
                    às
                    suas necessidades específicas, desde projetos simples até campanhas complexas.
                </p>
                <div class="contato-whatsapp"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                            svg {
                                fill: #114d05
                            }
                        </style>
                        <path
                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg> 11 94071-9244</div>
                <div class="contato-email"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                            svg {
                                fill: #ffffff
                            }
                        </style>
                        <path
                            d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z" />
                    </svg> contato@agenciaaffinity.com.br</div>

                <div class="icon-network">

                    <a href="https://www.facebook.com/agenciaaffinity/" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #ffffff
                                }
                            </style>
                            <path
                                d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z" />
                        </svg></a>
                    <a href="https://www.instagram.com/agenciaaffinity/" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #ffffff
                                }
                            </style>
                            <path
                                d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z" />
                        </svg></a>
                    <a href="https://www.youtube.com/channel/UCV7VU4_HG5Ti2LBAFMJ4wrQ/videos" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #ffffff
                                }
                            </style>
                            <path
                                d="M186.8 202.1l95.2 54.1-95.2 54.1V202.1zM448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-42 176.3s0-59.6-7.6-88.2c-4.2-15.8-16.5-28.2-32.2-32.4C337.9 128 224 128 224 128s-113.9 0-142.2 7.7c-15.7 4.2-28 16.6-32.2 32.4-7.6 28.5-7.6 88.2-7.6 88.2s0 59.6 7.6 88.2c4.2 15.8 16.5 27.7 32.2 31.9C110.1 384 224 384 224 384s113.9 0 142.2-7.7c15.7-4.2 28-16.1 32.2-31.9 7.6-28.5 7.6-88.1 7.6-88.1z" />
                        </svg></a>
                    <a href="https://www.linkedin.com/company/affinityagencia" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #ffffff
                                }
                            </style>
                            <path
                                d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                        </svg></a>
                </div>
            </div>

            <div class="footer-form">

                <div class="title-form-contato">Entre em contato</div>
                <p class="subtitule-form-contato">Entre em contato conosco, sua mensagem é importante para nós</p>

                <input type="text" placeholder="Nome" name="nome_contato">
                <input type="mail" placeholder="E-mail" name="email_contato">
                <input type="text" placeholder="Telefone" name="telefone_contato" class="telefone_contato">
                <textarea placeholder="Mensagem" name="mensagem_contato"></textarea>
                <button type="submit">Enviar</button>


            </div>

            </div>

        </footer>
    </form>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"
        integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('js/menu-mobile.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/banner.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    {{-- <script src="{{ asset('js/search.js') }}"></script> --}}
    <script src="{{ asset('js/email-news.js') }}"></script>
    <script src="{{ asset('js/email-contato.js') }}"></script>

</body>

</html>
