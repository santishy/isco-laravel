{!! Form::Open(['url'=>'/pagos','method'=>'POST', 'class'=>'form-horizontal' , 'id'=>"$form_id" ]) !!}
    <div class="form-group">
      <label for="titular" class="col-md-3 control-label">Titular</label>
      <div class="col-md-4">
        <input class="form-control" name="first_name" id="titular" placeholder="Nombre" type="text">
      </div>
      <div class="col-md-4">
        <input class="form-control" id="paterno" name="last_name" placeholder="Apellido" type="text">
      </div>
    </div>
    <div class="form-group">
      <label for="type" class="col-md-3 control-label">Tarjeta</label>
      <div class="col-md-8">
        <select id="type" name="type" class="form-control">
          <option value="visa">Visa</option>
          <option value="mastercard">MasterCard</option>
          <option value="americanexpress">AmericanExpress</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="number" class="col-md-3 control-label">Nom. Tarjeta</label>

      <div class="col-md-8">
        <input class="form-control" id="number" name="number" placeholder="Número de la tarjeta" type="number">
        <input type="hidden" value="credit_card" name="forma_pago">
      </div>
    </div>
    <div class="form-group">
      <label for="expire_month" class="col-md-3 control-label">Fecha Expiración</label>
      <div class="col-md-4">
        <input class="form-control" id="expire_month" name="expire_month" placeholder="03" type="number">
      </div>
      <div class="col-md-4">
        <input class="form-control" id="expire_year" name="expire_year" placeholder="2019" type="number">
      </div>
    </div>
    <div class="form-group">
      <label for="cvv2" class="col-md-2 col-md-offset-1 control-label">Cvv2</label>
      <div class="col-md-4">
        <input class="form-control" id="cvv2" name="cvv2" placeholder="Ejemplo: 456" type="number">
      </div>
    </div>
    <fieldset>
        <legend>Datos del envío</legend>
        <div class="form-group">
          <label for="expire_month" class="col-md-3 control-label">Correo</label>
          <div class="col-md-8">
            <input class="form-control" id="email" name="email" placeholder="fernando@hotmail.com" type="text" requerid>
          </div>
        </div>
        <div class="form-group">
          <label for="line1" class="col-md-3 control-label">Domicilio</label>
          <div class="col-md-8">
            <input class="form-control" id="line1" name="line1" placeholder="San Calletano 123" type="text">
          </div>
          <div class="col-md-8 col-md-offset-3">
            <input class="form-control" id="line2" name="line2" placeholder="Calle paralela " type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="state" class="col-md-3 control-label">Estado</label>
          <div class="col-md-8">
            <input class="form-control" id="state" name="state" placeholder="Colima" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-md-3 control-label">Ciudad</label>
          <div class="col-md-8">
            <input class="form-control" id="city" name="city" placeholder="Guadalajara" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="postal_code" class="col-md-3 control-label">Codigo Postal</label>
          <div class="col-md-8">
            <input class="form-control" id="postal_code" name="poste_code" placeholder="Colima" type="text">
          </div>
        </div>
        <div class="form-group">
            <label for="phone" class="col-md-3 control-label">Telefono</label>
            <div class="col-md-8">
              <input class="form-control" id="phone" name="phone" placeholder="3531098823" type="text">
            </div>
        </div>

    </fieldset>
{!! Form::Close() !!}
