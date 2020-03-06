@extends('blades.app')

@section('title', 'Locales - Crear Local')

@section('css')
@endsection

@section('content')
<h5><a href="{{ url('app/locales') }}">Recibos </a> >> Crear Recibo</h5>


<form class="row" role="form" method="POST" enctype="multipart/form-data" id="app">
    {{ csrf_field() }}

    <input type="hidden" name="business_id" v-model="business_id">
    <input type="hidden" name="amount" v-model="amount">
    <input type="hidden" name="type" v-model="type">
    <input type="hidden" name="month" v-model="month">
    <input type="hidden" name="year" v-model="year">

    <div class="form-group col l4 s12">
      <label for="exampleInputEmail1">Seleccione un Negocio: </label>
      <select v-model="business_id" @change="setBusiness($event)">
        <option></option>
        <option  v-for="bus in business" v-bind:value="bus.id"> @{{ bus.name }}</option>
      </select>      
    </div>

    <div class="form-group col l4 s12">
      <label for="exampleInputEmail1">Tipo de Recibo: </label>
      <select v-model="type" @change="checkType($event)">
        <option value="1">Mensualidad</option>
        <option value="2">Deposito</option>
        <option value="3">Otro</option>        
      </select>      
    </div>
    
    <div class="form-group col l4 s6" v-if="businessSelected != null">
      <label for="amount">Monto: </label>
      <input type="number" class="materialize-textarea" v-model="amount">
    </div>

  {{-- <div class="form-group col l4 s6" > --}}
    <div class="form-group col l4 s6" v-if="businessSelected && type == 1 && viewMonth">  
      <label for="month">Mes: </label>
      <select v-model="month" @change="checkMonth()">
        <option v-for="m of months" v-bind:value="m.value">@{{ m.view }}</option>
      </select>    
    </div>

    <div class="form-group col l4 s6" v-if="businessSelected && type == 1">
      <label for="exampleInputEmail1">Año: </label>
      <input type="number"  class="materialize-textarea" v-model="year">
    </div>
    
    <div class="col l12"><br>
      <button type="submit" class="btn blue"  v-if="businessSelected">Crear Recibo</button>
    </div>
  </form>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
  var app = new Vue({
    el: '#app',
    data: {
        
        business: {!! $business !!},
        business_id: null,
        businessSelected: null,
        month: null,
        year: null,
        amount: 0,
        type: 1,
        viewMonth: true,
        months: [
            {value: 1, view: 'Enero'},
            {value: 2, view: 'Febrero'},
            {value: 3, view: 'Marzo'},
            {value: 4, view: 'Abril'},
            {value: 5, view: 'Mayo'},
            {value: 6, view: 'Junio'},
            {value: 7, view: 'Julio'},
            {value: 8, view: 'Agosto'},
            {value: 9, view: 'Septiembre'},
            {value: 10, view: 'Octubre'},
            {value: 11, view: 'Noviembre'},
            {value: 12, view: 'Diciembre'},
        ]
    },
    created: function(){      

      const date = new Date()
      this.month = date.getMonth() + 1
      this.year = date.getFullYear()

    },

    methods: {

      setBusiness(event) {
        this.intervalViewMonth()
        if(this.business_id == '')
          this.businessSelected = null

        this.amount = 0

        for(let bus of this.business)
          if(bus.id == this.business_id) {
            this.businessSelected = bus;
            if(this.type == 1)
              this.amount = bus.current_monthly.amount
            break;
          }
        
      },
      checkType() {
        this.intervalViewMonth()
        if(this.type == 1 && this.businessSelected)
          this.amount = this.businessSelected.current_monthly.amount
        else
          this.amount = 0

      }, 
      checkMonth() {

      },

      intervalViewMonth(){
        setTimeout(() => $('select').formSelect(), 100)
      
      }

    }
  })
</script>
@endsection