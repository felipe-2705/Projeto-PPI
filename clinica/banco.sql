CREATE TABLE p_enderecos
(
   id int PRIMARY KEY auto_increment,
   cep char(10) UNIQUE,
   logradouro varchar(50),
   estado varchar(50),
   cidade varchar(50)
) ENGINE=InnoDB;

CREATE TABLE p_pessoa
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   sexo char(1),
   email varchar(50) UNIQUE,
   telefone varchar(50),
   cep varchar(10) UNIQUE,
   cidade varchar(50),
   estado char(2),
   logradouro varchar(50)
) ENGINE=InnoDB;

CREATE TABLE p_funcionario
(
   codigo int PRIMARY KEY,
   data_contrato date,
   salario float,
   senha_hash varchar(255),
   FOREIGN KEY (codigo) REFERENCES p_pessoa(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE p_medico
(
   codigo int PRIMARY KEY,
   crm varchar(7),
   especialidade varchar(50),
   FOREIGN KEY (codigo) REFERENCES p_funcionario(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE p_paciente
(
   codigo int PRIMARY KEY,
   peso float,
   altura float,
   tipo_sanguineo char(3),
   FOREIGN KEY (codigo) REFERENCES p_pessoa(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE p_agenda
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   p_data date,
   horario varchar(6),
   sexo char(1),
   email varchar(50),
   codigo_medico int not null,
   FOREIGN KEY (codigo_medico) REFERENCES p_medico(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;
