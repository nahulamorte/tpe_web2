<?php require 'templates/header.phtml' ?>

<form action="agregarcategoria" method="post">
    <label for="nombre">Nombre de la categoria</label>
    <input type="text" name="nombre" id="nombre" required />
    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" id="descripcion" required />
    <button type="submit">Enviar</button>
</form>

<?php require 'templates/footer.phtml' ?>