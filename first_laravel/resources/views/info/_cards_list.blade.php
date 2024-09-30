@php
    use App\Models\Info;
    /**
     * @var Info[] $models
     */
@endphp

<div class="row">
    @foreach($models as $model)
        <div class="col-md-3">
            <div class="card mb-2">
                <img style="width:120px; height:120px; border-radius:100%; margin:10px auto 0"
                    src="{{$model->image ? $model->image->src : Storage::disk("infos")->url('guest.jpg')}}" />
                <div class="card-body text-center">
                    <h1 class="card-title">{{$model->first_name}} {{$model->last_name}}</h1>
                    <div class="badge bg-{{$model->is_active ? "success" : "warning text-dark"}}"
                        style="margin: 0 auto; display:block">{{$model->is_active ? "Active" : "Inactive"}}</div>
                    <p>{{$model->birthday}}</p>
                    <h2>{{round($model->averageRating, 1)}} <i class="fa fa-star" style="color:darkgoldenrod;"
                            aria-hidden="true"></i>
                        </h>
                        @if(count($model->feedbacks) != 0)
                            <h3>Останні 3 відгуки:</h3>
                        @endif
                        @foreach ($model->last3feedbacks as $feedback)
                            <div class="badge bg-{{$feedback->rating < 2 ? "danger" : ($feedback->rating > 3 ? "success" : "warning text-dark")}}"
                                style="margin: 5px auto; display:block">{{$feedback->comment}}</div>
                        @endforeach
                        <button class="view-reviews btn btn-outline-success fs-4 mt-4 w-100" style="padding:0; "
                            data-id="{{$model->id}}">Відгуки</button>
                        <button class="add-review btn btn-outline-primary fs-4 my-2 w-100" style="padding:0"
                            data-id="{{$model->id}}">Залишии відгук</button>
                </div>
            </div>
        </div>
    @endforeach
</div>