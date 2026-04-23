# 🔐 Guia de Criptografia de Dados Sensíveis

## Implementação Realizada

Os seguintes campos sensíveis agora são **criptografados automaticamente** no banco de dados:

- `initial_document` - CPF/CNPJ do cliente
- `birth_date` - Data de nascimento
- `license_plate` - Placa do veículo

## Como Funciona

### Encrypted Casts (Laravel)

O Laravel usa a classe `Illuminate\Database\Eloquent\Casts\Encrypted` para:

1. **Ao salvar** → Criptografa o valor usando `APP_KEY`
2. **Ao recuperar** → Descriptografa automaticamente na memória
3. **No banco** → Dados armazenados criptografados

```php
// No código - você trabalha com valores descriptografados
$simulation->initial_document = '12345678900'; // String normal
$simulation->save(); // Armazena criptografado no BD

// Ao recuperar - descriptografa automaticamente
echo $simulation->initial_document; // '12345678900'
```

## 🔧 Configuração Necessária

### 1. APP_KEY
Sua `APP_KEY` no `.env` deve ser uma chave de 32 caracteres:
```env
APP_KEY=base64:QPUSmU4Ut6kncd8IGKP1JNR9q/KjDs77LreYMHxCLN0=
```

✅ Você já tem isso configurado!

### 2. Criptografar Dados Existentes

Se você já tem dados no banco, execute:

```bash
php artisan encrypt:simulations
```

Isso irá:
- Iterar por todos os registros em chunks de 100
- Criptografar os campos sensíveis
- Manter tudo transacional e seguro

## 📊 Exemplo de Uso na API

### Criando uma simulação
```json
POST /api/simulations
{
  "initial_document": "12345678900",
  "birth_date": "1990-05-15",
  "license_plate": "ABC1234",
  ...
}
```

**No banco de dados** (criptografado):
```
initial_document: eyJpdiI6IkxyMFp6OWpYVnZBQUZjQllRb2RjV1E9PSIsInZhbHVlIjoib3hzS...
birth_date: eyJpdiI6IkFhQkRGMzAxMjM0NTY3ODkiLCJ2YWx1ZSI6Im9YczZWb0VTdWJjVGM...
license_plate: eyJpdiI6ImNkQWVGUjdhVTVrMlFNUlJRUjRnMkE9PSIsInZhbHVlIjoiZjZE...
```

**Na resposta da API** (descriptografado):
```json
{
  "initial_document": "12345678900",
  "birth_date": "1990-05-15",
  "license_plate": "ABC1234",
  ...
}
```

## 🔒 Segurança

### O que está protegido?
- ✅ Dados em repouso (no banco)
- ✅ Acesso direto ao banco via SQL não mostra valores reais
- ✅ Se `APP_KEY` for vazada, antigos registros poderiam ser descriptografados

### O que NÃO está protegido?
- ⚠️ Dados em trânsito (use HTTPS sempre)
- ⚠️ Dados na memória (enquanto a aplicação está executando)
- ⚠️ Se `APP_KEY` for comprometida

### Recomendações de Segurança
1. **Mantenha `APP_KEY` segura** - nunca versione no Git (`.env` local)
2. **Use HTTPS em produção** - protege dados em trânsito
3. **Backup seguro** - se precisar fazer backup, criptografe os arquivos de backup
4. **Rotação de chaves** (avançado) - para migrações de segurança

## 🛠️ Operações Avançadas

### Adicionar mais campos criptografados

Se precisar criptografar mais campos no futuro, basta adicionar ao `$casts`:

```php
protected $casts = [
    'numero_conta' => 'encrypted',
    'agencia' => 'encrypted',
];
```

Então execute:
```bash
php artisan encrypt:simulations
```

### Consultas com dados criptografados

⚠️ **Importante**: Você NÃO pode fazer queries exatas em campos criptografados!

```php
// ❌ NÃO FUNCIONA
Simulation::where('initial_document', '12345678900')->first();

// ✅ FUNCIONA
$simulation = Simulation::find($id);
if ($simulation->initial_document === '12345678900') { ... }
```

Se precisar buscar por documento, considere:
- Manter um hash do documento em campo separado
- Usar um campo de índice criptografado com chave separada
- Implementar search diferente

## 📝 Webhook com Dados Criptografados

O webhook N8N receberá os dados **descriptografados** (como aparecem na API):

```json
{
  "event": "simulation.created",
  "data": {
    "initial_document": "12345678900",
    "birth_date": "1990-05-15",
    "license_plate": "ABC1234"
  }
}
```

## ✅ Checklist de Implementação

- [x] Configurar encrypted casts no modelo Simulation
- [x] Criar comando para criptografar dados existentes
- [ ] Executar `php artisan encrypt:simulations` (se houver dados)
- [ ] Testar criação/atualização de simulações
- [ ] Verificar se os dados estão criptografados no banco
- [ ] Certificar-se de que HTTPS está ativo em produção

## 🧪 Teste Rápido

```bash
# Criar simulação de teste
php artisan tinker
>>> $sim = App\Models\Simulation::create([...])
>>> $sim->initial_document  // Mostra: 12345678900

# Verificar no banco (direto)
SELECT initial_document FROM simulations WHERE id = '...'
# Mostra: eyJpdiI6IkxyMFp6OWpYVnZBQUZjQllRb2RjV1E9PSIsInZhbHVlIjoib3hzS...
```

Dados criptografados = ✅ Sucesso!
