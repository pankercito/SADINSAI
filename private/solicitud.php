<form action="sendmail.php" method="post" id="solicitud">
    <div class="mb-3">
      <label for="mail" class="form-label">Email</label>
      <input type="email" class="form-control" name="mail" id="mail" aria-describedby="emailHelpId" placeholder="abc@mail.com" required>
      <small id="emailHelpId" class="form-text text-muted">ingresa un correo | (obligatorio)</small>
    </div>
    <div class="mb-3">
      <label for="razon" class="form-label">Motivo</label>
      <input type="text"
        class="form-control" name="razon" id="razon" aria-describedby="helpId" placeholder="..." required>
      <small id="helpId" class="form-text text-muted">explica el motivo de tu solicitud  | (obligatorio)</small>
    </div>
</form>