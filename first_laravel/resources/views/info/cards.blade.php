@php
    use App\Models\Info;
    /**
     * @var Info[] $models
     */
@endphp


@extends('layouts.my-layout')

@section('title', 'Info cards')

@section('content')

<!-- Stars -->

<style>
    i.fa-star:not([selected]) {
        color: black;
    }

    i.fa-star[selected] {
        color: darkgoldenrod;
    }
    i.fa-star:hover {
        cursor: pointer
    }
</style>

<!-- Search -->

@include("info._search")

<!-- Modal -->

<div class="modal fade" id="review-form-modal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Відгук до <span id="span_for_name">name here</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Оцінка</label>
                    <div class="rate-select d-flex w-50" style="justify-content:space-around; font-size:20px">
                        <div><i class="fa fa-2x fa-star" data-id="1"></i></div>
                        <div><i class="fa fa-2x fa-star" data-id="2"></i></div>
                        <div><i class="fa fa-2x fa-star" data-id="3"></i></div>
                        <div><i class="fa fa-2x fa-star" data-id="4"></i></div>
                        <div><i class="fa fa-2x fa-star" data-id="5"></i></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Відгук</label>
                    <textarea class="review-form-text form-control" rows="3" style="resize:none"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                <button type="button" class="send-review btn btn-primary" data-success-message="Відгук було надіслано"
                    data-error-message="Сталася помилка" data-href="{{route('info.info', [4])}}">Залишити відгук</button>
            </div>
        </div>
    </div>
</div>

<!-- Main Cards -->

<div class="row">
    @foreach($models as $model)
        <div class="col-md-3">
            <div class="card mb-2">
                <img style="width:80px; height:80px; border-radius:100%; margin:5px auto 0"
                    src="{{$model->image ? $model->image->src : Storage::disk("infos")->url('guest.jpg')}}" />
                <div class="card-body text-center">
                    <h5 class="card-title">{{$model->first_name}} {{$model->last_name}}</h5>
                    <div class="badge bg-{{$model->is_active?"success":"warning"}}" style="margin: 0 auto; display:block">{{$model->is_active}}</div>
                    <p>{{$model->birthday}}</p>
                    <p>{{$model->averageRating}} <i class="fa fa-star" style="color:darkgoldenrod;" aria-hidden="true"></i>
                    </p>
                    <button class="view-reviews btn btn-outline-success" style="width:100%; padding:0"
                        data-id="{{$model->id}}">Відгуки</button>
                    <button class="add-review btn btn-outline-primary" style="width:100%; padding:0"
                        data-id="{{$model->id}}">Залишии відгук</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection


@section("scripts")
<script>

    var selectedRate;

    var myModal = new bootstrap.Modal(document.getElementById('review-form-modal'), {
        keyboard: false
    })

    $('button.add-review')
        .on('click', e => {
            let id = $(e.target).data('id')
            fetch(`/api/v1/info/${id}`).then(r => r.json()).then(data => {
                $('#span_for_name').val(`${data["first_name"]} ${data["last_name"]}`)
                myModal.show()
            })
        })

    $('button.view-reviews')
        .on('click', e => {
            let id = $(e.target).data('id')
            fetch(`/api/v1/info/${id}`).then(r => r.text()).then(html => {
                myModal.show()
            })
        })
</script>
@endsection