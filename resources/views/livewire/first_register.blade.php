@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12 text-center  " style="margin-right:320px">
            <div class="col-md-12 ">
                <br>
   <div class="form-row" style="margin-right:120px">
                        <div class="form-group">
                                <i class="zmdi zmdi-pin"></i>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="name"    placeholder="اسم المستخدم">
                                  @error('name')

                                  <span class="text-danger">{{ $message }}</span>
            @enderror
                            </div>
  <div class="form-group">
                                <i class="zmdi zmdi-pin"></i>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" style="margin-right:5px" wire:model.lazy="email"    placeholder="ايميل">
                                   @error('email')

                                  <span class="text-danger">{{ $message }}</span>
            @enderror
                            </div>
                        </div>
 <div class="form-row">
                        <div class="form-group" style="margin-right:120px">
                                <i class="zmdi zmdi-pin"></i>
    <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.lazy="password"  placeholder="كلمة السر">
                                   @error('password')

                                  <span class="text-danger">{{ $message }}</span>
            @enderror
                            </div>
  <div class="form-group">
                                <i class="zmdi zmdi-pin"></i>
                                <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" style="margin-right:5px"  wire:model.lazy="confirmpassword"  placeholder="تاكيد كلمة السر">
                                    @error('confirmpassword')

                                  <span class="text-danger">{{ $message }}</span>
            @enderror
                            </div>
                        </div>


                         <div class="form-row" style="margin-right:120px">
                        <div class="form-group">
                                <i class="zmdi zmdi-pin"></i>
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror" wire:model.lazy="mobile"  placeholder="رقم الجوال">
                                  @error('mobile')

                                  <span class="text-danger">{{ $message }}</span>
            @enderror
                            </div>

                        </div>
                <button class="btn btn-success  nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                        type="button" style="margin-right:350px">التالي
                </button>
            </div>
        </div>
  </div>
