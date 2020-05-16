<template>
  <form>
    <div class="form-group">
      <input type="text" name="line1" class="form-control" placeholder="Domicilio, ejemplo: Calle #numero">
    </div>
    <div class="form-group">
      <input type="text" name="line2" class="form-control" placeholder="Referencia">
    </div>
    <div class="form-group">
      <select name="state" class="form-control">
          <option value="">Seleccione un estado</option>
          <option value="Aguascalientes">Aguascalientes</option>
          <option value="Baja California">Baja California</option>
          <option value="Baja California Sur">Baja California Sur</option>
          <option value="Campeche">Campeche</option>
          <option value="Chiapas">Chiapas</option>
          <option value="Chihuahua">Chihuahua</option>
          <option value="CDMX">Ciudad de México</option>
          <option value="Coahuila">Coahuila</option>
          <option value="Colima">Colima</option>
          <option value="Durango">Durango</option>
          <option value="Estado de México">Estado de México</option>
          <option value="Guanajuato">Guanajuato</option>
          <option value="Guerrero">Guerrero</option>
          <option value="Hidalgo">Hidalgo</option>
          <option value="Jalisco">Jalisco</option>
          <option value="Michoacán">Michoacán</option>
          <option value="Morelos">Morelos</option>
          <option value="Nayarit">Nayarit</option>
          <option value="Nuevo León">Nuevo León</option>
          <option value="Oaxaca">Oaxaca</option>
          <option value="Puebla">Puebla</option>
          <option value="Querétaro">Querétaro</option>
          <option value="Quintana Roo">Quintana Roo</option>
          <option value="San Luis Potosí">San Luis Potosí</option>
          <option value="Sinaloa">Sinaloa</option>
          <option value="Sonora">Sonora</option>
          <option value="Tabasco">Tabasco</option>
          <option value="Tamaulipas">Tamaulipas</option>
          <option value="Tlaxcala">Tlaxcala</option>
          <option value="Veracruz">Veracruz</option>
          <option value="Yucatán">Yucatán</option>
          <option value="Zacatecas">Zacatecas</option>
      </select>
    </div>
    <div class="form-group">
      <input type="text" name="city" placeholder="Ciudad" class="form-control">
    </div>
    <div class="form-group">
      <input type="text" name="postal_code" placeholder="Codigo Postal" class="form-control">
    </div>
    <div class="form-group mb-0">
      <input type="text" name="recipient_name" placeholder="Persona dirigida" class="form-control">
    </div>
    
  </form>
</template>

<script>
export default {
}
</script>

<style lang="css" scoped>
</style>
