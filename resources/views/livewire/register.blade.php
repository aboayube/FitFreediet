<div>

<style>
.contact-us-form{
    font-family: "Lato-Regular";
    font-size: 14px;
    margin: 0;
    color: #999;
    background:  url({{asset("wizard/images/form-wizard-bg.jpg")}}) no-repeat center center;;
    height: 120vh;
    background-size: cover;
    display: flex;
    align-items: center;
    font-size: 19px;
    justify-content: center;
}

:focus {
    outline: none;
}

textarea {
    resize: none;
}

input,
textarea,
select,
button {
    font-family: "Lato-Regular";
    font-size: 14px;
}

select {
    -moz-appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
}
select option[value=""][disabled] {
    display: none;
}

p,
h1,
h2,
h3,
h4,
h5,
h6,
ul {
    margin: 0;
}

ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

a {
    text-decoration: none;
}

textarea {
    resize: none;
}

img {
    max-width: 100%;
    vertical-align: middle;
}

.wrapper {
    width: 826px;
    height: 620px;
    padding: 63px 90px 0;
    background: #fff;
}

.wizard {
    position: relative;
}

.stepwizard-step{
    display: inline-block;
    text-align:center;
    margin-right: 150px;
}
</style>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}    </div>
    @endif
    <section class="section contact-us-form">
    <div class="container">
      <div class="row " style="background-color: white;">

      <div class="col-xl-12 text-center">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                   class="btn btn-circle">
                      @if($currentStep==1)
<img src="{{asset("wizard/images/step-2-active.png")}}">
                      @else
<img src="{{asset("wizard/images/step-2.png")}}">
                       @endif

                   </a>
                <p>مرحلة الاولي</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                   class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">
                    @if($currentStep==2)
<img src="{{asset("wizard/images/step-1-active.png")}}">
                      @else
<img src="{{asset("wizard/images/step-1.png")}}">
                       @endif
                   </a>
                <p>المرحلة الثانية</p>
            </div>
    </div>
</div>
</div>
@include('livewire.first_register')
@include('livewire.second_register')
</div>
</div>
</section>
