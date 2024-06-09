@extends('layouts.user')

@section('content')

<style>
    p{
        text-align: justify;
        line-height: 1.6;
    }
    li{
        color:#009DA6;
    }
</style>

<div class="container">
    <div class="justify-content-center mt-3" style="margin-left: 10%; margin-right: 10%">
        <ul class="list-group list-group-horizontal justify-content-center ">
            <li class="list-group-item border-0 me-5" style="background-color: #11ffee00;"><a href="{{ route('users.terms') }}" style="color: #009DA6"><b>Terms and Conditions</b></a></li>
            <li class="list-group-item border-0 ms-5" style="background-color: #11ffee00;"><a href="{{ route('users.privacy') }}" style="color: grey"><b>Privacy Policy</b></a></li>
        </ul>
        <hr style="background-color: black">

        <div>
            <h3 class="mb-4"><b>Terms of Use</b></h3>
            <p class="mb-4">EduLab’s mission is to improve lives through learning. We enable anyone anywhere to create and share educational content (instructors) and to access that educational content to learn (students). We consider our marketplace model the best way to offer valuable educational content to our users. We need rules to keep our platform and services safe for you, us, and our student and instructor community. These Terms apply to all your activities on the EduLab website.</p>
            
            <h3 class="mb-4"><b>Table of Contents</b></h3>
            <ol class="fs-6">
                <a href="#1"><li>Accounts</li></a>
                <a href="#2"><li>Content Enrollment</li></a>
                <a href="#3"><li>Content and Behaviour Rules</li></a>
                <a href="#4"><li>Subscription Terms</li></a>
                <a href="#5"><li>Miscellaneous Legal Terms</li></a>
                <a href="#6"><li>Using EduLab at Your Own Risk</li></a>
            </ol>

            <h3 id="1" class="mb-4"><b>1. Accounts</b></h3>
            <p class="fs-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec purus turpis. Cras orci risus, elementum id imperdiet et, pulvinar nec purus. Etiam luctus pharetra neque, et pharetra sapien hendrerit at. Nullam non fermentum risus, non dignissim magna. Morbi ac sapien eget elit viverra elementum. Praesent fringilla venenatis magna, pretium venenatis purus fringilla non. In porttitor lacus ut eros pulvinar dapibus. Nulla volutpat pharetra leo, ut sollicitudin elit feugiat eget. In at lorem vitae lorem luctus auctor. Nulla hendrerit hendrerit leo, quis lobortis quam aliquam vitae. Nunc ornare accumsan neque vel venenatis.</p>
            <p class="fs-6">Cras vitae nunc fermentum, fermentum mauris ac, venenatis leo. Suspendisse mollis varius felis, quis sodales urna condimentum id. Cras nec faucibus leo, ornare varius orci. Nam lectus velit, finibus at ullamcorper vel, interdum nec nisl. Suspendisse ligula justo, condimentum in libero sed, commodo convallis enim. Cras hendrerit lacus posuere massa convallis, non aliquam ligula bibendum. Sed dapibus elit pulvinar ex bibendum finibus. Ut quis felis tristique mi interdum consectetur. Pellentesque commodo, eros vel egestas tristique, ligula tellus volutpat libero, et elementum dui eros id nibh. Donec dictum sapien sit amet euismod pretium. Vivamus a lacinia ligula. Ut vulputate maximus ornare. Phasellus eleifend, ante non lobortis faucibus, sapien lorem dignissim dolor, a iaculis velit sapien sit amet ipsum.</p>
            <p class="fs-6">Sed blandit urna non purus ullamcorper pellentesque. Phasellus dapibus vitae odio sit amet rhoncus. Curabitur quis nisl erat. Cras eu mattis odio, in maximus lectus. Vivamus turpis nunc, mattis id arcu vitae, bibendum cursus augue. Nulla facilisis auctor erat at aliquam. Aliquam fringilla ut tellus nec molestie. Ut mi nibh, egestas nec sem at, porta fringilla felis. Duis aliquam erat quis ipsum viverra, quis dapibus nisi porta. Sed quis efficitur sem, ut eleifend ex. Morbi ipsum eros, feugiat quis nisl eu, venenatis lobortis nunc.</p>

            <h3 id="2" class="mb-4"><b>2. Content Enrollment</b></h3>
            <p class="fs-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec purus turpis. Cras orci risus, elementum id imperdiet et, pulvinar nec purus. Etiam luctus pharetra neque, et pharetra sapien hendrerit at. Nullam non fermentum risus, non dignissim magna. Morbi ac sapien eget elit viverra elementum. Praesent fringilla venenatis magna, pretium venenatis purus fringilla non. In porttitor lacus ut eros pulvinar dapibus. Nulla volutpat pharetra leo, ut sollicitudin elit feugiat eget. In at lorem vitae lorem luctus auctor. Nulla hendrerit hendrerit leo, quis lobortis quam aliquam vitae. Nunc ornare accumsan neque vel venenatis.</p>
            <p class="fs-6">Cras vitae nunc fermentum, fermentum mauris ac, venenatis leo. Suspendisse mollis varius felis, quis sodales urna condimentum id. Cras nec faucibus leo, ornare varius orci. Nam lectus velit, finibus at ullamcorper vel, interdum nec nisl. Suspendisse ligula justo, condimentum in libero sed, commodo convallis enim. Cras hendrerit lacus posuere massa convallis, non aliquam ligula bibendum. Sed dapibus elit pulvinar ex bibendum finibus. Ut quis felis tristique mi interdum consectetur. Pellentesque commodo, eros vel egestas tristique, ligula tellus volutpat libero, et elementum dui eros id nibh. Donec dictum sapien sit amet euismod pretium. Vivamus a lacinia ligula. Ut vulputate maximus ornare. Phasellus eleifend, ante non lobortis faucibus, sapien lorem dignissim dolor, a iaculis velit sapien sit amet ipsum.</p>

            <h3 id="3" class="mb-4"><b>3. Content and Behaviour Rules</b></h3>
            <p class="fs-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec purus turpis. Cras orci risus, elementum id imperdiet et, pulvinar nec purus. Etiam luctus pharetra neque, et pharetra sapien hendrerit at. Nullam non fermentum risus, non dignissim magna. Morbi ac sapien eget elit viverra elementum. Praesent fringilla venenatis magna, pretium venenatis purus fringilla non. In porttitor lacus ut eros pulvinar dapibus. Nulla volutpat pharetra leo, ut sollicitudin elit feugiat eget. In at lorem vitae lorem luctus auctor. Nulla hendrerit hendrerit leo, quis lobortis quam aliquam vitae. Nunc ornare accumsan neque vel venenatis.</p>
            <p class="fs-6">Cras vitae nunc fermentum, fermentum mauris ac, venenatis leo. Suspendisse mollis varius felis, quis sodales urna condimentum id. Cras nec faucibus leo, ornare varius orci. Nam lectus velit, finibus at ullamcorper vel, interdum nec nisl. Suspendisse ligula justo, condimentum in libero sed, commodo convallis enim. Cras hendrerit lacus posuere massa convallis, non aliquam ligula bibendum. Sed dapibus elit pulvinar ex bibendum finibus. Ut quis felis tristique mi interdum consectetur. Pellentesque commodo, eros vel egestas tristique, ligula tellus volutpat libero, et elementum dui eros id nibh. Donec dictum sapien sit amet euismod pretium. Vivamus a lacinia ligula. Ut vulputate maximus ornare. Phasellus eleifend, ante non lobortis faucibus, sapien lorem dignissim dolor, a iaculis velit sapien sit amet ipsum.</p>
            
            <h3 id="4" class="mb-4"><b>4. Subscription Terms</b></h3>
            <p class="fs-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec purus turpis. Cras orci risus, elementum id imperdiet et, pulvinar nec purus. Etiam luctus pharetra neque, et pharetra sapien hendrerit at. Nullam non fermentum risus, non dignissim magna. Morbi ac sapien eget elit viverra elementum. Praesent fringilla venenatis magna, pretium venenatis purus fringilla non. In porttitor lacus ut eros pulvinar dapibus. Nulla volutpat pharetra leo, ut sollicitudin elit feugiat eget. In at lorem vitae lorem luctus auctor. Nulla hendrerit hendrerit leo, quis lobortis quam aliquam vitae. Nunc ornare accumsan neque vel venenatis.</p>
            <p class="fs-6">Cras vitae nunc fermentum, fermentum mauris ac, venenatis leo. Suspendisse mollis varius felis, quis sodales urna condimentum id. Cras nec faucibus leo, ornare varius orci. Nam lectus velit, finibus at ullamcorper vel, interdum nec nisl. Suspendisse ligula justo, condimentum in libero sed, commodo convallis enim. Cras hendrerit lacus posuere massa convallis, non aliquam ligula bibendum. Sed dapibus elit pulvinar ex bibendum finibus. Ut quis felis tristique mi interdum consectetur. Pellentesque commodo, eros vel egestas tristique, ligula tellus volutpat libero, et elementum dui eros id nibh. Donec dictum sapien sit amet euismod pretium. Vivamus a lacinia ligula. Ut vulputate maximus ornare. Phasellus eleifend, ante non lobortis faucibus, sapien lorem dignissim dolor, a iaculis velit sapien sit amet ipsum.</p>
            <p class="fs-6">Sed blandit urna non purus ullamcorper pellentesque. Phasellus dapibus vitae odio sit amet rhoncus. Curabitur quis nisl erat. Cras eu mattis odio, in maximus lectus. Vivamus turpis nunc, mattis id arcu vitae, bibendum cursus augue. Nulla facilisis auctor erat at aliquam. Aliquam fringilla ut tellus nec molestie. Ut mi nibh, egestas nec sem at, porta fringilla felis. Duis aliquam erat quis ipsum viverra, quis dapibus nisi porta. Sed quis efficitur sem, ut eleifend ex. Morbi ipsum eros, feugiat quis nisl eu, venenatis lobortis nunc.</p>

            <h3 id="5" class="mb-4"><b>5. Miscellaneous Legal Terms</b></h3>
            <p class="fs-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque lacinia lorem lobortis, hendrerit leo eget, condimentum justo. Aenean luctus libero sed felis porta pretium. Nam vehicula suscipit turpis sit amet pellentesque. Cras eros lacus, tincidunt vitae volutpat nec, gravida eget ligula. Etiam gravida nunc sed urna porttitor, a ultricies lorem vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis egestas risus in lectus congue suscipit. Curabitur sed faucibus neque, tincidunt ultricies neque. Vivamus eros ante, molestie eget mi maximus, pharetra consectetur nisl. Quisque sodales tellus in tincidunt commodo. Phasellus ultricies diam nec risus faucibus mollis. Nulla eu neque quam. Aliquam sodales risus eget erat pretium feugiat. Fusce non mi facilisis, accumsan lorem vel, sollicitudin purus.</p>

            <p class="fs-6">Cras ac facilisis augue, sed eleifend arcu. Nulla urna tellus, laoreet sed erat sit amet, accumsan ultrices massa. Nulla viverra elementum elementum. Nam dolor lectus, dictum sed sollicitudin et, consequat vel lacus. Aliquam sit amet dignissim arcu. Integer nec vulputate ante. Maecenas eu tortor quis erat efficitur sagittis eu mollis nisl.</p>

            <p class="fs-6">Praesent et nisi a libero dictum pretium eu a sem. Donec eleifend dignissim felis sit amet consectetur. Fusce ipsum metus, porttitor eget ex vel, elementum porttitor lectus. Etiam quis velit congue, mollis enim eu, tempor lectus. Praesent orci nibh, sodales nec arcu eu, aliquet viverra neque. Sed non diam a nisl lacinia eleifend ut et orci. Nullam sed velit ut odio pharetra luctus. Nulla sed dolor in mauris porttitor accumsan. Fusce porttitor, justo id sollicitudin tincidunt, elit erat maximus sem, sit amet lacinia lacus justo ac neque.</p>

            <p class="fs-6"> Nulla facilisi. Curabitur mollis velit lobortis vehicula consequat. In orci urna, condimentum et ante nec, commodo pulvinar ligula. Morbi ut mauris convallis, vestibulum lorem vel, pulvinar nisi. Nulla non diam sed elit suscipit elementum sit amet ac quam. Morbi ut ligula ac justo ullamcorper feugiat. Donec in fermentum felis. Sed rhoncus fermentum hendrerit. Cras vel hendrerit urna. Sed libero elit, laoreet tempor augue vitae, hendrerit scelerisque quam. Morbi quis ipsum sed elit posuere porttitor sed eget velit. Aliquam consectetur, tortor in aliquam ultrices, risus risus rhoncus enim, sit amet maximus quam nibh porttitor neque. Vivamus accumsan ultrices leo, at tincidunt dolor varius sit amet. Nulla hendrerit enim enim, eu rutrum nisi viverra nec. Integer id diam diam.</p>

            <h3 id="6" class="mb-4"><b>6. Using EduLab at Your Own Risk</b></h3>
            <p class="fs-6">Cras ac facilisis augue, sed eleifend arcu. Nulla urna tellus, laoreet sed erat sit amet, accumsan ultrices massa. Nulla viverra elementum elementum. Nam dolor lectus, dictum sed sollicitudin et, consequat vel lacus. Aliquam sit amet dignissim arcu. Integer nec vulputate ante. Maecenas eu tortor quis erat efficitur sagittis eu mollis nisl.</p>

            <p class="fs-6">Praesent et nisi a libero dictum pretium eu a sem. Donec eleifend dignissim felis sit amet consectetur. Fusce ipsum metus, porttitor eget ex vel, elementum porttitor lectus. Etiam quis velit congue, mollis enim eu, tempor lectus. Praesent orci nibh, sodales nec arcu eu, aliquet viverra neque. Sed non diam a nisl lacinia eleifend ut et orci. Nullam sed velit ut odio pharetra luctus. Nulla sed dolor in mauris porttitor accumsan. Fusce porttitor, justo id sollicitudin tincidunt, elit erat maximus sem, sit amet lacinia lacus justo ac neque.</p>

            <p class="fs-6"> Nulla facilisi. Curabitur mollis velit lobortis vehicula consequat. In orci urna, condimentum et ante nec, commodo pulvinar ligula. Morbi ut mauris convallis, vestibulum lorem vel, pulvinar nisi. Nulla non diam sed elit suscipit elementum sit amet ac quam. Morbi ut ligula ac justo ullamcorper feugiat. Donec in fermentum felis. Sed rhoncus fermentum hendrerit. Cras vel hendrerit urna. Sed libero elit, laoreet tempor augue vitae, hendrerit scelerisque quam. Morbi quis ipsum sed elit posuere porttitor sed eget velit. Aliquam consectetur, tortor in aliquam ultrices, risus risus rhoncus enim, sit amet maximus quam nibh porttitor neque. Vivamus accumsan ultrices leo, at tincidunt dolor varius sit amet. Nulla hendrerit enim enim, eu rutrum nisi viverra nec. Integer id diam diam.</p>
        </div>
    </div>
    
</div>
@endsection