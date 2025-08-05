<!DOCTYPE html>

<html lang="{{ theme_meta('locale') }}" dir="{{ theme_meta('dir') }}">

<head>
    <title>Pivlu | Sample page</title>
    <meta name="description" content="Site meta description">

    @include("{$theme_path}.includes.head")
</head>

<body>

    @include(theme_menu())

    @include(theme_section('hero'))

    <!-- Main Content -->
    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="post">

                    <h1 class="section-heading mb-4">Reaching for the Stars</h1>

                    <div class="meta">
                        <img class="avatar rounded-circle" src="{{ theme_asset('assets/img/sample/person.jpg') }}" alt="Profile"> <a href="#"> John Doe</a> <i class="bi bi-calendar ms-3"></i> December 21,
                        2020, 18:45 <i class="bi bi-clock ms-3"></i> 4 min to read
                    </div>

                    <div class="content">
                        <p class='first-paragraph'>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which
                            all the directions eventually meet, in which there is no center
                            because every point, or none, is center — an equal earth which all men occupy as equals. The airman's earth, if free men make it, will be truly round: a globe in practice, not in theory.</p>

                        <p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from
                            science.</p>

                        <p>What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth.</p>

                        <p>A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That's how I felt seeing the Earth for the first time. I
                            could not help but love and cherish
                            her.
                        </p>

                        <h2 class="section-heading">Reaching for the Stars</h2>

                        <p>As we got further and further away, it [the Earth] diminished in size. Finally it shrank to the size of a marble, the most beautiful you can imagine. That beautiful, warm, living object looked
                            so fragile, so delicate, that if you
                            touched it with a finger it would crumble and fall apart. Seeing this has to change a man.</p>

                        <div class="mb-3">
                            <img class="img-fluid rounded shadow" src="{{ theme_asset('assets/img/sample/post1_big.jpg') }}" alt="Image">
                            <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span>
                        </div>
                        

                        <p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where
                            no man has gone before.</p>

                        <p>As I stand out here in the wonders of the unknown at Hadley, I sort of realize there’s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.</p>


                        <h2 class="section-heading">The Final Frontier</h2>

                        <p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is
                            always the thrill of just beginning.</p>

                        <p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is
                            always the thrill of just beginning.</p>

                        <blockquote class="blockquote">The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far
                            too little for the next ten.</blockquote>

                        <p>Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human
                            development.</p>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- End container -->

    @include(theme_footer())

</body>

</html>
