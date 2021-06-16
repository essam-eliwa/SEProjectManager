@extends('layouts.student_topbar')
@section('content')

<script>
    var element = document.getElementById("projects");
    element.classList.add("show");

</script>



<div class ="container">
<h2 Style="margin-top:5%;">Welcome to {{$project[0]->ProjectTitle}}</h2>

<h4 Style="margin-top:5%;">Project Description</h4>

<p>{{$project[0]->ProjectDesc}}.</p>

<h4 Style="margin-top:5%;">Client info:</h4>

<p><b>Client Name : </b>{{$project[0]->ClientName}}.</p>

<p><b>Client number : </b>{{$project[0]->ClientNumber}}.</p>

<p><b>Client Email : </b>{{$project[0]->ClientEmail}}.</p>

<h4 Style="margin-top:5%;">Team info:</h4>

<p><b>Team members : </b>{{$project[0]->ClientName}}.</p>

<p><b>Team number : </b>{{$project[0]->ClientName}}.</p>


    <div style="margin-top:80px;max-width:100%;" class="row d-flex justify-content-center ">

   



<h1>Deliverables</h1>
</div>
    <div style="margin-left:30px;margin-top:30px;margin-bottom:30px;max-width:100%;padding:15px;border:1px solid;border-radius:25px;border-color:#C63E47;overflow:auto;" class="row d-flex justify-content-center ">
    @php
        $i = 0

    @endphp
        @foreach ($submissions as $submission)
        <!-- had to add a margin right becuase they were so close to each other? -->
        <div class="turningButtonContainer" style="margin-right:30px;width:200px;height:250px;margin-top:2%">
            <div class="turningButtonContainerInner">
                <div class="turningButton"><i style="font-size:25px;margin-top:55px;" class="icons far fa-dot-circle"></i><span style="font-size:35px;">{{$submission->submissionName}}</span></div>
                <div class="turnedButton">
                    <p>
                        <p class="text-center">Submission name</p>
                        <p class="text-center">{{$submission->submissionName}}</p>
                        <!--this means that the value the student has submitted matches the submissions in general -->
                        @if($submissionValues[$i]->SubmissionId == $submission->id)
                            <button class="btn btn-light norms" data-toggle="modal" onClick="setSubmissionModal({{$submission->id}})" data-target="#myModalHorizontal" data-toggle="tooltip" title="Add Submission">Edit Submission</button>

                            
                        @else
                            <button class="btn btn-light norms" data-toggle="modal" onClick="setSubmissionModal({{$submission->id}})" data-target="#myModalHorizontal" data-toggle="tooltip" title="Add Submission">Add Submission</button>

                        @endif

                        @php
                            $i++;
                        @endphp
                    </p>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>









<!-- discussion section -->
<div class = "row d-flex justify-content-center" style="padding-left:20px;padding-top:20px;">
<h3>Discussion</h3>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-sm-7">
        
        
        <div class="review-block">
        
        @foreach($discussions as $discussion)
            <hr />
            <div class="row">
                <div class="col-sm-3">
                    <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                    <div class="review-block-name"><a href="#">{{$discussion->Surname}}</a></div>
                    
                </div>
                <div class="col-sm-9">
                    
                    <div class="review-block-description">{{$discussion->Message}}</div>
                </div>
            </div>
            <hr />
        @endforeach




            <form action="{{route('storeDiscussion')}}" method="post">


                {{csrf_field()}}

            <div class="row">
            
                <div class = "col-10 ">
                    <div class="col"><textarea id="message" name="message" style="height:70%;width:90%;" placeholder="Whats on your mind" maxlength="150"></textarea></div>
                    <input type="hidden" id = "projectId" name="projectId" value="{{$project[0]->id}}">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
                <div class = "col-2">
                    <input style="margin-top: 10px; width:100px; " type="submit" class="btn btn-outline-dark" value = "send">
                    

                


                </div>
            </div>

            </form>



        </div>
    </div>
</div>

</div>
<!-- Modal -->
<!-- myModalHorizontal -->
<div id="myModalHorizontal" class="modal modal-file" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Modal content -->
    <div class="modal-content modal-file-content">
        <form action="{{route('storeSubmissionValue')}}" method="post" enctype="multipart/form-data">

            {{csrf_field()}}

            <div style="width:100.5%; height:40px; background-color:#C63E47;margin-left:-1px;">
                <p class="text-center" style="color:#fff;font-size:25px;">Select a file</p>
            </div>
            
            <input style="margin-left: 90px;margin-top:50px;" type="file" id = "file" name= "file" style="width:200px">
            <input type="hidden" name = "SubmissionId" id = "SubmissionId">
            <input type="hidden" name="TemplateId" id="TemplateId" value = "{{$project[0]->ProjectTemplateId}}">
            <input type="hidden" name="ProjectId" id="ProjectId" value = "{{$project[0]->id}}">


            <div class="row">
                <button style="padding:5px; width: 75px;margin-left:60px;margin-top:25px;" class="btn btn-outline">upload</button>
                <input type = 'submit' style="padding:5px; width: 75px;margin-left:60px;margin-top:25px;" class="btn btn-outline">upload</button>

                <button style="padding:5px; width: 75px;margin-left:110px;margin-top:25px;" class="btn btn-outline"  class="close" data-dismiss="modal" aria-label="Close">close</button>
            </div>
        </form>
    </div>
</div>



<style>
    /* projects tab */


    .turningButtonContainer {
        margin-left: 0px;
        margin-top: 0px;
    }
    

    
    html,body
    {
        width: 100% !important;
        height: 100% !important;
        margin: 0px !important;
        padding: 0px !important;
        overflow-x: hidden !important;
    }



   
</style>

<script>

function setSubmissionModal(id)
{
    $("#SubmissionId").val(id);
}

</script>
                      
@endsection

