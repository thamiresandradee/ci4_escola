<div class="row">
    <h6>Dados Pessoais</h6>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Nome Completo" id="name" name="name" value="<?php echo old('name', $parent->name); ?>">
            <label for="name">Nome Completo</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" value="<?php echo old('email', $parent->email); ?>">
            <label for="email">E-mail</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="tel" class="form-control phone" placeholder="Telefone" id="telefone" name="telefone" value="<?php echo old('telefone', $parent->telefone); ?>">
            <label for="telefone">Telefone</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control cpf" placeholder="CPF" id="cpf" name="cpf" value="<?php echo old('cpf', $parent->cpf); ?>">
            <label for="cpf">CPF</label>
        </div>
    </div>
</div>
<div class="row mt-4">
    <h6>Dados de Endereço</h6>
    <div class="col-md-2">
        <div class="form-floating mb-3">
            <input type="text" class="form-control cep" placeholder="CEP" id="postalcode" name="postalcode" value="<?php echo old('postalcode', $parent->address->postalcode); ?>">
            <label for="cep">CEP</label>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Rua" id="street" name="street" value="<?php echo old('street', $parent->address->street); ?>">
            <label for="street">Rua</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Nº" id="number" name="number" value="<?php echo old('number', $parent->address->number); ?>">
            <label for="number">Nº</label>
        </div>
    </div>
    <div class="col-md">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Cidade" id="city" name="city" value="<?php echo old('city', $parent->address->city); ?>">
            <label for="city">Cidade</label>
        </div>
    </div>
    <div class="col-md">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Bairro" id="district" name="district" value="<?php echo old('district', $parent->address->district); ?>">
            <label for="district">Bairro</label>
        </div>
    </div>
    <div class="col-md">
        <div class="form-floating mb-3">
            <input type="text" class="form-control uf" placeholder="UF" id="state" name="state" value="<?php echo old('state', $parent->address->state); ?>">
            <label for="state">UF</label>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <button type="submit" class="btn bg-gradient-dark">Salvar</button>
    </div>
</div>

<?= $this->section('js'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="<?php echo  base_url('assets/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/mask/app.js'); ?>"></script>

<script>
    document.getElementById('postalcode').addEventListener('change', function(){
        
        const postalcode = this.value;

        if(postalcode.length === 9){
            fetch(`https://viacep.com.br/ws/${postalcode}/json/`)
            .then(response =>response.json())
            .then(data => {
                document.getElementById('street').value = data.logradouro;
                document.getElementById('district').value = data.bairro;
                document.getElementById('city').value = data.localidade;
                document.getElementById('state').value = data.uf;
            })
            .catch(error => {
                console.log(`Erro ao consultar o CEP: ${erro}`);
            });
        }
    });
</script>
<?= $this->endSection(); ?>