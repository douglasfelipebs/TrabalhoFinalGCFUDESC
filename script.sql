--SCRIPTS BANCO LOJA INFORMÁTICA:

--CRIANDO TABELA DE PRODUTOS
create table if not exists tbproduto (
	procodigo integer not null,
	pronome character varying (50) not null,
	prodescricao character varying (500),
	profabricante character varying (100) not null,
	provalor numeric (15,2) not null
);
alter table tbproduto drop constraint if exists tbproduto_pkey;
alter table tbproduto add primary key (procodigo);

--CHUMBANDO PRODUTOS
WITH series AS (SELECT generate_series(1, (SELECT max(procodigo)
					     FROM tbproduto)) AS mysequence)
insert into tbproduto VALUES (SELECT COALESCE((SELECT min(mysequence) FROM series WHERE series.mysequence NOT IN(SELECT procodigo FROM tbproduto)), (SELECT max(procodigo) + 1          FROM tbproduto), 1), 'Notebook', 'Notebook ACER 16GB RAM/Intel Core i7 8th Gen/1TB SDD', 'ACER', 5000.00);
insert into tbproduto VALUES (SELECT COALESCE((SELECT min(mysequence) FROM series WHERE series.mysequence NOT IN(SELECT procodigo FROM tbproduto)), (SELECT max(procodigo) + 1          FROM tbproduto), 1), 'Notebook', 'Notebook DELL 16GB RAM/Intel Core i7 8th Gen/1TB SDD', 'DELL', 5000.00);
insert into tbproduto VALUES (SELECT COALESCE((SELECT min(mysequence) FROM series WHERE series.mysequence NOT IN(SELECT procodigo FROM tbproduto)), (SELECT max(procodigo) + 1          FROM tbproduto), 1), 'Notebook', 'Notebook SAMSUNG 16GB RAM/Intel Core i7 8th Gen/1TB SDD', 'SAMSUNG', 3000.00);


/* Cliente  */
CREATE TABLE IF NOT EXISTS TBCLIENTE (
	CLICODIGO INTEGER NOT NULL,
	CLINOME CHARACTER VARYING(50) NOT NULL,
	CLICPF CHARACTER VARYING(14) NOT NULL,
	CLILOGRADOURO CHARACTER VARYING(200) NOT NULL,
	CLINUMERO BIGINT NOT NULL,
	CLIBAIRRO CHARACTER VARYING(80) NOT NULL,
	CLICIDADE CHARACTER VARYING(80) NOT NULL,
	CLICEP CHARACTER VARYING(9) NOT NULL,
	CLIUF CHARACTER VARYING(2) NOT NULL
);

ALTER TABLE TBCLIENTE DROP CONSTRAINT IF EXISTS tbcliente_pkey;
ALTER TABLE TBCLIENTE ADD PRIMARY KEY (CLICODIGO);

ALTER TABLE TBCLIENTE DROP CONSTRAINT IF EXISTS check_cpf;
ALTER TABLE TBCLIENTE ADD CONSTRAINT check_cpf CHECK (CLICPF ~e'/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/');

ALTER TABLE TBCLIENTE DROP CONSTRAINT IF EXISTS check_cep;
ALTER TABLE TBCLIENTE ADD CONSTRAINT check_cep CHECK (CLICEP ~e'\\d{5}[-]\\d{2}');