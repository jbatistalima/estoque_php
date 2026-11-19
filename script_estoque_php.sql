CREATE TABLE usuarios (
id SERIAL PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
login VARCHAR(50) UNIQUE NOT NULL,
senha VARCHAR(255) NOT NULL,
perfil VARCHAR(20) DEFAULT 'OPERADOR',
data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- CLIENTES
-- ==========================
CREATE TABLE clientes (
id SERIAL PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
cpf_cnpj VARCHAR(20),
telefone VARCHAR(20),
email VARCHAR(100),
endereco VARCHAR(200),
bairro VARCHAR(100),
cidade VARCHAR(100),
estado VARCHAR(2),
data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
-- ==========================
-- FORNECEDORES
-- ==========================
CREATE TABLE fornecedores (
id SERIAL PRIMARY KEY,
razao_social VARCHAR(150) NOT NULL,
fantasia VARCHAR(150),
cnpj VARCHAR(20),
telefone VARCHAR(20),
email VARCHAR(100),
endereco VARCHAR(200),
bairro VARCHAR(100),
cidade VARCHAR(100),
estado VARCHAR(2),
data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

-- ==========================
-- CATEGORIAS
-- ==========================
CREATE TABLE categorias (
id SERIAL PRIMARY KEY,
descricao VARCHAR(100) NOT NULL
);

-- ==========================
-- PRODUTOS
-- ==========================
CREATE TABLE produtos (
id SERIAL PRIMARY KEY,
codigo VARCHAR(30) UNIQUE,
descricao VARCHAR(150) NOT NULL,
categoria_id INTEGER,
fornecedor_id INTEGER,
unidade VARCHAR(10) DEFAULT 'UN',
estoque_atual NUMERIC(12,2) DEFAULT 0,
estoque_minimo NUMERIC(12,2) DEFAULT 0,
preco_custo NUMERIC(12,2) DEFAULT 0,
preco_venda NUMERIC(12,2) DEFAULT 0,
ativo BOOLEAN DEFAULT TRUE,

CONSTRAINT fk_prod_categoria
FOREIGN KEY (categoria_id)
REFERENCES categorias(id),

CONSTRAINT fk_prod_fornecedor
FOREIGN KEY (fornecedor_id)
REFERENCES fornecedores(id)
);

-- ==========================
-- MOVIMENTAÇÕES DE ESTOQUE
-- ==========================
CREATE TABLE movimentacoes (
id SERIAL PRIMARY KEY,
produto_id INTEGER NOT NULL,
usuario_id INTEGER,
tipo VARCHAR(10) NOT NULL,
quantidade NUMERIC(12,2) NOT NULL,
observacao TEXT,
data_movimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
CONSTRAINT fk_mov_produto
FOREIGN KEY(produto_id)
REFERENCES produtos(id),
CONSTRAINT fk_mov_usuario
FOREIGN KEY(usuario_id)
REFERENCES usuarios(id));

-- ==========================
-- COMPRAS
-- ==========================
CREATE TABLE compras (
id SERIAL PRIMARY KEY,
fornecedor_id INTEGER NOT NULL,
usuario_id INTEGER,
data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
valor_total NUMERIC(12,2),

CONSTRAINT fk_comp_fornecedor
	FOREIGN KEY(fornecedor_id)
	REFERENCES fornecedores(id),

CONSTRAINT fk_comp_usuario    
	FOREIGN KEY(usuario_id)
	REFERENCES usuarios(id));

-- ==========================
-- ITENS DA COMPRA
-- ==========================
CREATE TABLE compras_itens (
id SERIAL PRIMARY KEY,
compra_id INTEGER NOT NULL,
produto_id INTEGER NOT NULL,
quantidade NUMERIC(12,2),
valor_unitario NUMERIC(12,2),
subtotal NUMERIC(12,2),

CONSTRAINT fk_ci_compra
FOREIGN KEY(compra_id)
REFERENCES compras(id)
ON DELETE CASCADE,

CONSTRAINT fk_ci_produto
FOREIGN KEY(produto_id)
REFERENCES produtos(id)
);

-- ==========================
-- VENDAS
-- ==========================
CREATE TABLE vendas (
id SERIAL PRIMARY KEY,
cliente_id INTEGER,
usuario_id INTEGER,
data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
valor_total NUMERIC(12,2),

CONSTRAINT fk_venda_cliente
FOREIGN KEY(cliente_id)
REFERENCES clientes(id),

CONSTRAINT fk_venda_usuario
FOREIGN KEY(usuario_id)
REFERENCES usuarios(id)
);

-- ==========================
-- VENDAS_ITENS
-- ==========================
CREATE TABLE vendas_itens (
id SERIAL PRIMARY KEY,
venda_id INTEGER NOT NULL,
produto_id INTEGER NOT NULL,
quantidade NUMERIC(12,2),
valor_unitario NUMERIC(12,2),
subtotal NUMERIC(12,2),

CONSTRAINT fk_vi_venda
FOREIGN KEY(venda_id)
REFERENCES vendas(id)
ON DELETE CASCADE,

CONSTRAINT fk_vi_produto
FOREIGN KEY(produto_id)
REFERENCES produtos(id)
);
