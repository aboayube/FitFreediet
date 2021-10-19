<?php
namespace App\Helpers;
class BMI{
 private $length;
 private $weight;
 private $age;
 private $gender;
 private $bmi;
 private $bmivalue;
 private $activity;
 private $calories;
    public function __construct($length,$weight,$age,$gender,$activity)
    {
        $this->length=$length;
        $this->weight=$weight;
        $this->age=$age;
        $this->gender=$gender;   
        $this->activity=$activity;   
    }

    private function bmi(){
           //  نجيب طول بمتر
           $lengthMetar = $this->length / 100;
           // بعمل معادلة لمعرفة bmi مع تقريب لاقرب رقم
        $this->bmi= ceil($this->weight / ($lengthMetar * $lengthMetar));
           //تصنيفات bmi
    }
    
    private function statusbmi(){
        //تصنيفات bmi

        if ($this->bmi < 15) {
          $this->bmivalue = 'نحافة';
      } else if ($this->bmi > '15.9' && $this->bmi < '22.5') {
          $this->bmivalue = 'طبيعي';
      } else if ($this->bmi > '22.6' && $this->bmi < '30') {
          $this->bmivalue = 'زيادة وزن';
      } else if ($this->bmi > '30' && $this->bmi < '35') {
          $this->bmivalue = 'سمنة درجة 1';
      } else if ($this->bmi > '35.9' && $this->bmi < '40') {
          $this->bmivalue = 'سمنة درجة 2';
      } else if ($this->bmi > '40.9' && $this->bmi < '45.9') {
          $this->bmivalue = 'سمنة درجة 2';
      } else if ($this->bmi > '45') {
          $this->bmivalue = ' عرضة للامراض المزمنة';
      }
  }
  public function calculatorBmi(){
      $this->bmi();
      $this->statusbmi();
        // عمل معادلة
        if ($this->gender == 'female') {
            $needCalory = $this->ceiling((10 * $this->weight) + (6.25 * $this->length) - (5 * $this->age) - 161);
            $sorat = $this->ceiling($needCalory * $this->activity);
        
            if ($this->bmi > 30) {
                $this->calories = $sorat - 500;
            } else if ($this->bmi < 15) {
                $this->calories = $sorat + 500;
            }else{
                $this->calories=$sorat;
            }
        } else if ($this->gender == 'male') {
            $needCalory = $this->ceiling((10 * $this->weight) + (6.25 * $this->length) - (5 * $this->age) + 5);
            $sorat = $this->ceiling($needCalory * $this->activity);

            if ($this->bmi > 30) {
                $this->calories = $sorat - 500;

            } else if ($this->bmi < 15) {
                $this->calories = $sorat + 500;
            }else{
                $this->calories = $sorat ;

            }
        }
        return array(
            'bmi'=>$this->bmi,
            'bmivalue'=>$this->bmivalue,
            'calories'=>$this->calories,
      
        );
  }

  private function ceiling($number, $significance = 100)
  {
      return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
  }
}