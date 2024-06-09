@extends('layouts.user')

@section('content')

<style>
    p{
        text-align: justify;
    }
</style>

<div class="container">
    <div class="justify-content-center mt-3" style="margin-left: 10%; margin-right: 10%">
        <ul class="list-group list-group-horizontal justify-content-center ">
            <li class="list-group-item border-0 me-5" style="background-color: #11ffee00;"><a href="{{ route('users.terms') }}" style="color: grey"><b>Terms and Conditions</b></a></li>
            <li class="list-group-item border-0 ms-5" style="background-color: #11ffee00;"><a href="{{ route('users.privacy') }}" style="color: #009DA6"><b>Privacy Policy</b></a></li>
        </ul>
        <hr style="background-color: black">

        <div>
            <h2 class="mb-4"><b>Privacy Policy</b></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus condimentum elit eget justo luctus accumsan. Nam mattis ultrices odio. Praesent porta interdum urna. Sed sed ultrices quam. Vestibulum sapien odio, volutpat ut vehicula vel, pellentesque vel ex. Aliquam ornare turpis et lacus congue, a sagittis odio auctor. Nam mattis sodales risus quis eleifend. Nunc sit amet magna ac metus sagittis pulvinar non non turpis. Nunc at ipsum non massa volutpat congue eget eu est. Vestibulum malesuada elit lorem, vel consectetur justo gravida a.</p>

            <p>Integer vestibulum rutrum enim aliquam interdum. Ut pretium, odio non dictum rutrum, odio justo vulputate neque, non lobortis augue augue at velit. Fusce tempus tempus velit non ornare. Mauris vel consectetur urna. Praesent pretium tincidunt laoreet. Sed vel lorem vel quam sollicitudin hendrerit eu a odio. Sed pellentesque ex risus, sed lobortis ipsum vestibulum ut. Vivamus viverra risus facilisis, tristique augue a, interdum nulla. In ac neque ut enim aliquam maximus. Aliquam erat volutpat. Praesent sed neque arcu. Vivamus quis hendrerit ante. Donec malesuada varius enim, in porta augue tristique vitae. Nam vel tristique neque.</p>

            <p>Sed a nibh nec nisi lacinia aliquet et luctus sem. Curabitur non magna ut mauris eleifend convallis vel et ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean ornare nisl id ligula molestie rutrum. Proin scelerisque mi justo, id blandit sem eleifend ac. Nulla a arcu nec mi feugiat consectetur a a ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget blandit nisi, eu pharetra elit. In tincidunt ante eget vestibulum consequat. Nunc a feugiat felis, ut dignissim mi. Curabitur massa turpis, elementum non risus vel, feugiat convallis mauris. Nam nec ipsum gravida, scelerisque est quis, cursus lorem. Maecenas in tempor erat, non mollis tellus. Sed iaculis est iaculis rutrum elementum. In eu ex id nisi gravida iaculis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

            <p>Donec eu lectus urna. Phasellus vitae ante nec dolor condimentum eleifend at ut est. Aliquam non lacus vel ex vulputate porta. Cras urna metus, sollicitudin vitae risus non, tincidunt venenatis leo. Duis porttitor imperdiet tempus. Nulla quis lorem quis lectus imperdiet imperdiet. Integer semper lorem et iaculis elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel metus varius, sollicitudin quam volutpat, accumsan dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec eget nisl orci. Cras at justo cursus, tincidunt urna et, rutrum tortor. Fusce tellus ex, dapibus sed augue a, condimentum finibus nunc. Maecenas eget cursus leo. Mauris quis erat quis sem sollicitudin condimentum.</p>
        </div>
    </div>
    
</div>
@endsection