@extends('layouts.app')

@section('content')
<div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


<form action="/question" method="post" enctype="multipart/form-data">
    @csrf
             <!-- Soru textarea Başlangıç -->
    <div class="soru">
        <i class="fas fa-pencil-alt prefix"></i>
        <label class="sorutextheader">Soru Metnini Giriniz :</label>
        <div class="mb-4">
    
          <textarea class="textArea" name="text">
    
          </textarea>
        </div>
        </div>
         <!-- Soru textarea Bitiş -->
          <!-- Soru resim butonu Başlangıç -->
        <div class="upload-btn-wrapper">
          <button class="btn imgBtn ml-3">Resim Ekle</button>
          <input type="file" name="image" />
        </div>
         <!-- Soru resim butonu bitiş -->
          <!-- Soru konu butonu Başlangıç -->
        <div class="dropdown">
            <select class="custom-select btn imgBtn" name="lesson">
              <option selected value="">Konu seç...</option>
              @foreach ($lessons as $lesson)
                <option value="{{$lesson->id}}">{{$lesson->name}}</option>
              @endforeach
            </select>
        </div>
         <!-- Soru konu butonu Bitiş -->
        
         <div class="row m-0 mt-4 mb-1">
            <div class="col-1 p-0 text-center">
                Doğru Şık
            </div>
            <div class="col-10 text-center">
              Şık metni
            </div>
            <div class="col-1 p-0 pr-3 text-center">
              Resim
            </div>
          </div>
          @foreach (['A', 'B', 'C', 'D'] as $value)
          <div class="row border rounded m-0 mb-1">
           <div class="col-1">
               <section class="plan cf">
                 <input type="radio" name="answer" id="{{$value}}" value="{{$value}}"><label class="m-0 mt-2" for="{{$value}}">{{$value}}</label>
               </section>
           </div>
           <div class="col-10">
             <div class="m-1">
               <textarea name="choice{{$value}}text" class="textArea"></textarea>
               </div>
           </div>
           <div class="col-1 upload-btn-wrapper">
             <button class="imgBtn btn m-0 mt-2">img</button>
             <input type="file" name="choice{{$value}}image" />
           </div>
         </div>
          @endforeach
         <div class="container"></div>
      <button type="submit" class="btn btnAdd btn-block mt-4">Ekle</button>
  </form>
        </div>
@endsection