<form action="{{ url('products/new') }}" method="POST">
    @csrf
    <label>Nome:</label><br>
    <input name="name" type="text" /><br>
    <label>Descrição:</label><br>
    <input name="description" type="textarea" /><br>
    <label>Quantidade:</label><br>
    <input name="quantity" type="number" /><br>
    <label>Preço:</label><br>
    <input name="price" type="number" /><br>
    <label>Tipo:</label><br>
    <input name="type_id" type="number" /><br>
    <input type="submit" value="Salvar" />
</form>