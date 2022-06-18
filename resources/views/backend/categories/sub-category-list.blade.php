<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>{{$dash}} <a href="{{Route('editCategory', $subcategory->id)}}">{{$subcategory->name}}</a></td>
        <td>{{$subcategory->slug}}</td>
        <td>{{$subcategory->parent->name}}</td>
        <td>@if($subcategory->posts->count())
                {{$subcategory->posts->count()}}
            @else
                0
            @endif</td>
        <td>
            <div class="dropdown text-center">
                <button class="btn d-flex align-items-center justify-content-center m-auto" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bi bi-three-dots-vertical fs-5'></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{Route('editCategory', $subcategory->id)}}">
                            <i class='bi bi-pencil-square me-1'></i>
                            Edytuj
                        </a>
                    </li>
                    <li>
                        <button class="dropdown-item dropdown-item d-flex align-items-center justify-content-start delete" data-id="{{$subcategory->id}}">
                            <i class='bi bi-trash me-1'></i>
                            Usuń
                        </button>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
    @if(count($subcategory->subcategory))
        @include('backend.categories.sub-category-list',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach