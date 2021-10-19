@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif
        <div class="col-xs-12 text-center" style="margin-right:320px">
            <div class="col-md-12">
                <br>

                <div class="form-row">
 <div class="form-holder">
                                <i class="zmdi zmdi-pin-drop"></i>
 <input type="number" wire:model.lazy="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="وزن">
                                @error('weight')
                      
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                            </div>

             <div class="form-holder">
                                <i class="zmdi zmdi-pin-drop"></i>
<input type="number" wire:model.lazy="length" class="form-control @error('length') is-invalid @enderror"  placeholder="طول">
                                @error('length')
                      
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                            </div>

    <div class="form-holder">
                                <i class="zmdi zmdi-pin-drop"></i>
                                <input type="number" wire:model.lazy="age" class="form-control @error('age') is-invalid @enderror"  placeholder="عمر">
                                @error('age')
                      
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                            </div>
                </div>

                <div class="form-row mt-2">

                <div class="col">
                        <label for="title">نشاط</label>
                        <select wire:model="activity" class="form-control @error('activity') is-invalid @enderror">
                        <option value="-">  -</option>
                        <option value="1.2">خامل غير نشيط</option>
                        <option value="1.3">خامل (مكتبي) </option>
                        <option value="1.4">قليل نشاط</option>
                        <option value="1.6">متوسط نشاط</option>
                        <option value="1.8">قوي نشاط</option>
                        </select>
                        @error('activity')
                      
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                <div class="col">
                        <label for="title">هدفك</label>
                        <select wire:model="aims" class="form-control @error('aims') is-invalid @enderror">
                        <option value="-"> -</option>
                        <option value="زيادة">زيادة وزن</option>
                        <option value="نقصان">نقصان وزن</option>
                        </select>
                        @error('aims')
                      
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                <div class="col">
                        <label for="title">جنس</label>
                        <select wire:model="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="-">-</option>
                        <option value="male">ذكر</option>
                        <option value="female">انثي</option>
                        </select>
                        @error('gender')
                      
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row  mt-2">
                <div class="col">
                        <label for="title">اذكر ما امراض التي تعاني منها</label>
                      <textarea wire:model.lazy="diseasesName" class="form-control"></textarea>
                        
                    </div>
                <div class="col">
                        <label for="title">هل تتناول ادوية معينة</label>
                      <textarea wire:model.lazy="medicine" class="form-control"></textarea>
                     
                    </div>

            </div>
            <div class="col">
                        <label for="title">ملاحظات</label>
                      <textarea wire:model.lazy="notes" class="form-control"></textarea>
                       
                    </div>
<div class="form-check mt-4" style="font-size: 20px;">
  <input class="form-check-input  @error('agreePolice') is-invalid @enderror" wire:model="agreePolice" type="checkbox" value="" id="defaultCheck1" style="margin-top:10px">
  <label class="form-check-label" for="defaultCheck1" style="margin-right:15px ;">
  @error('agreePolice')

<span class="text-danger">{{ $message }}</span>
@enderror
    موافقه علي شروط <a href="{{route('frontend.police')}}" target="_blank">fit free</a>
  </label>
   @error('agreePolice')
                      
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
</div>
            <br>

<button class="btn btn-danger  nextBtn btn-lg pull-left" type="button" wire:click="back(1)">
   الرجوع                </button>

<button class="btn btn-success  nextBtn btn-lg pull-right" type="button"
        wire:click="secondStepSubmit">تسجيل</button>


        </div>
    </div>
