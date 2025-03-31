// Configuração do Supabase
const supabaseUrl = '<?php echo SUPABASE_URL; ?>';
const supabaseKey = '<?php echo SUPABASE_KEY; ?>';
const supabase = supabase.createClient(supabaseUrl, supabaseKey);

// Carregar transações
async function loadTransactions() {
  const { data, error } = await supabase
    .from('transaction')
    .select(`
      id,
      date,
      quantity,
      value,
      amount,
      ticker,
      transaction_type:transaction_type_id(name)
    `)
    .order('date', { ascending: false });

  if (error) {
    console.error("Erro ao carregar:", error);
    return;
  }

  const tableBody = document.getElementById('transactions-table');
  tableBody.innerHTML = data.map(transaction => `
    <tr>
      <td>${formatDate(transaction.date)}</td>
      <td>${transaction.transaction_type.name}</td>
      <td>${transaction.ticker}</td>
      <td>${transaction.quantity}</td>
      <td>R$ ${transaction.value.toFixed(2)}</td>
      <td>R$ ${transaction.amount.toFixed(2)}</td>
      <td>
        <button class="btn btn-sm btn-warning" onclick="editTransaction(${transaction.id})">Editar</button>
        <button class="btn btn-sm btn-danger" onclick="deleteTransaction(${transaction.id})">Excluir</button>
      </td>
    </tr>
  `).join('');
}

// Formatar data
function formatDate(dateString) {
  const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
  return new Date(dateString).toLocaleDateString('pt-BR', options);
}

// Adicionar transação
document.getElementById('transaction-form').addEventListener('submit', async (e) => {
  e.preventDefault();
  
  const formData = new FormData(e.target);
  const data = {
    date: formData.get('date'),
    id_transaction_type: parseInt(formData.get('id_transaction_type')),
    quantity: parseInt(formData.get('quantity')),
    value: parseFloat(formData.get('value')),
    tax: parseFloat(formData.get('tax')) || 0,
    ticker: formData.get('ticker'),
    id_brokerage: parseInt(formData.get('id_brokerage')),
    id_class: parseInt(formData.get('id_class'))
  };

  const { error } = await supabase
    .from('transaction')
    .insert(data);

  if (error) {
    alert('Erro ao cadastrar: ' + error.message);
  } else {
    alert('Transação cadastrada!');
    e.target.reset();
    loadTransactions();
  }
});

// Carregar dados ao iniciar
document.addEventListener('DOMContentLoaded', loadTransactions);
