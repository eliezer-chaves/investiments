<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu App Financeiro</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Seu CSS -->
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Minhas Transações</h1>
    
    <!-- Formulário de Adição -->
    <div class="card mb-4">
      <div class="card-body">
        <form id="transaction-form" class="row g-3">
          <div class="col-md-3">
            <label class="form-label">Data</label>
            <input type="date" class="form-control" name="date" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Tipo</label>
            <select class="form-select" name="id_transaction_type" required>
              <option value="2">Compra</option>
              <option value="3">Aporte</option>
              <option value="4">Proventos</option>
            </select>
          </div>
          <!-- Outros campos aqui -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Adicionar</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabela de Transações -->
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Ticker</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Total</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="transactions-table">
              <!-- Dados serão carregados via JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS + Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Supabase JS -->
  <script src="https://unpkg.com/@supabase/supabase-js@2"></script>
  <!-- Seu JavaScript -->
  <script src="js/app.js"></script>
</body>
</html>