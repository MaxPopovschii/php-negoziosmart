<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Fattura</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f9f9f9; }
        .fattura { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px gray; max-width: 500px; margin: auto; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <div class="fattura">
        <h1>📄 Fattura</h1>
        <p><strong>Cliente:</strong> <?= htmlspecialchars($cliente['nome']) ?> <?= htmlspecialchars($cliente['cognome']) ?></p>
        <p><strong>Telefono:</strong> <?= htmlspecialchars($telefono['marca']) ?> <?= htmlspecialchars($telefono['modello']) ?></p>
        <p><strong>Prezzo Intero:</strong> <?= htmlspecialchars($telefono['prezzo']) ?>€</p>
        <p><strong>Prezzo Scontato:</strong> <?= number_format($prezzoScontato, 2) ?>€</p>
    </div>
</body>
</html>
