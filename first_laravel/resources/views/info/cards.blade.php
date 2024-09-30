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

    i.fa-2x:hover {
        cursor: pointer
    }
</style>

<!-- Search -->

@include("info._search")

<!-- Modal -->

<div class="modal fade" id="review-form-modal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    </div>
</div>

<!-- Main Cards -->

<div id="cards_container">
    <div class="row">
    </div>
</div>
@endsection


@section("scripts")
<script>

    var selectedRate = 0;

    var myModal = new bootstrap.Modal(document.getElementById('review-form-modal'), {
        keyboard: false
    })

    loadCards()

    function loadCards() {
        fetch(`/info/cards_list/${$('.searcher').val()}`).then(r => r.text()).then(html => {
            $('#cards_container').html(html)
        }).then(() => {
            $('button.add-review')
                .on('click', e => {
                    let id = $(e.target).data('id')
                    fetch(`/api/v1/info/${id}`).then(r => r.json()).then(data => {
                        let html = `<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Відгук до ${data.data['first_name']} ${data.data['last_name']}</h5>
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
                    data-error-message="Сталася помилка" data-href="/api/v1/saveFeedback/${id}">Залишити
                    відгук</button>
            </div>
        </div>`

                        $('.modal-dialog').html(html)
                        myModal.show()
                        $('.rate-select [data-id]')
                            .attr('selected', false)
                            .on('click', e => {
                                let el = $(e.target)
                                selectedRate = Number(el.data('id'))

                                updateStarsSelection()
                            })
                        $('button.send-review').on('click', e => {
                            let target = $(e.target)
                            let url = target.data('href')
                            let success = target.data("success-message")
                            let error = target.data("error-message")

                            $.ajax({
                                type: "POST",
                                url: url,
                                contentType: 'application/json',
                                data: JSON.stringify(
                                    {
                                        comment: $('textarea.review-form-text').val(),
                                        rating: selectedRate
                                    }
                                ),
                                success: function () {
                                    console.log(data)
                                    myModal.hide()

                                    Swal.fire(success, "", "success").then(() => {
                                        window.location.reload()
                                    });
                                },
                                error: function () {
                                    Swal.fire(error, "", "error")
                                }
                            })
                        })
                    })
                })
            $('button.view-reviews')
                .on('click', e => {
                    let id = $(e.target).data('id')
                    fetch(`/api/v1/info/${id}`).then(r => r.json()).then(data => {
                        console.log(data)
                        let html = `    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Відгуки ` + data.data.first_name + ' ' + data.data.last_name + `</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">` + (data.data.feedbacks.length == 0 ?
                                `<h3 class="text-center">Відгуків немає</h3>` : '');
                        data.data.feedbacks.forEach(model => {
                            html += `<div class="card mb-2">
            <div class="card-body">
                    <div class="d-flex" style="justify-content:space-between;">
                    <div><h5 class="card-title" style="font-size:24px">${model.created_at}</h5></div>

                </div>
                <p class="mt-3 mb-1 text-white-50">Оцінка:</p>
                <div class="rate-select d-flex w-50" style="justify-content:space-around; font-size:20px">
                    <div><i class="fa fa-2x fa-star" ${model.rating >= 1 ? "selected" : ""}></i></div>
                    <div><i class="fa fa-2x fa-star" ${model.rating >= 2 ? "selected" : ""}></i></div>
                    <div><i class="fa fa-2x fa-star" ${model.rating >= 3 ? "selected" : ""}></i></div>
                    <div><i class="fa fa-2x fa-star" ${model.rating >= 4 ? "selected" : ""}></i></div>
                    <div><i class="fa fa-2x fa-star" ${model.rating >= 5 ? "selected" : ""}></i></div>
                </div>
                <p class="mt-3 mb-2 text-white-50">Відгук:</p>
                <p style="font-size:22px">${model.comment == "" ? "Відгук відсутній" : model.comment}</p>
            </div>
        </div>`
                        });
                        html += `</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Закрити</button>
    </div>
</div>`
                        $('.modal-dialog').html(html)
                        myModal.show()
                    })
                })
        })
    }

    function updateStarsSelection(event) {
        $('.rate-select [data-id]').each((i, e) => {
            let el = $(e)
            el.attr('selected', (Number(el.data('id')) <= selectedRate))
        })
    }


    $('.searcher').on("input", () => {
        loadCards()
    })
</script>
@endsection