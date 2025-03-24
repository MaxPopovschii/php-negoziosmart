<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Vendita Telefonino</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f2f2f2; }
        form { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px gray; max-width: 500px; margin: auto; }
        select, input, button { margin: 10px 0; padding: 8px; width: 100%; }
        .telefoni-lista { margin: 20px auto; max-width: 500px; background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 0 8px gray; }
    </style>
</head>
<body>

    <div class="telefoni-lista">
        <h3>📱 Telefoni Disponibili</h3>
        <?php foreach ($telefonini as $tel): ?>
            <p>ID: <?= htmlspecialchars($tel['ID']) ?> → <?= htmlspecialchars($tel['marca']) ?> <?= htmlspecialchars($tel['modello']) ?> | Prezzo: €<?= htmlspecialchars($tel['prezzo']) ?> | Q.tà: <?= htmlspecialchars($tel['quantita']) ?></p>
        <?php endforeach; ?>
    </div>

    <form method="post">
        <h3>Vendi Telefonino</h3>
        Cliente:
        <select name="cliente_id" required>
            <?php foreach ($clienti as $cli): ?>
                <option value="<?= $cli['id'] ?>">
                    <?= htmlspecialchars($cli['nome'] . ' ' . $cli['cognome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        ID Telefono da vendere:
        <input name="telefono_id" type="number" required placeholder="Inserisci ID telefono">

        <button name="vendi">Vendi</button>
    </form>

</body>
</html>
