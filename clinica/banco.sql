-- DROP TABLE p_agenda, p_paciente, p_medico, p_funcionario, p_pessoa;

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
   horario varchar(2),
   sexo char(1),
   email varchar(50),
   codigo_medico int not null,
   FOREIGN KEY (codigo_medico) REFERENCES p_medico(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO p_enderecos (id,cep,logradouro,estado,cidade)
VALUES
  (DEFAULT,'38500-000',NULL,'MG','Monte Carmelo'),
  (DEFAULT,'38400-100','Avenida Floriano Peixoto','MG','Uberlândia'),
  (DEFAULT,'38400-200','Rua Tiradentes','MG','Uberlândia'),
  (DEFAULT,'38400-300','Praça Lions Clube','MG','Uberlândia');

INSERT INTO p_pessoa (codigo,nome,sexo,email,telefone,cep,cidade,estado,logradouro)
VALUES
  (DEFAULT,'Susan de Moura','F','nibh.quisque@hotmail.edu','34-43567-1234','58456-577','Santa Luzia','SC','Rua 1'),
  (DEFAULT,'Thomas dos Anjos','M','et.netus@google.edu','54-43497-0987','58446-518','Camacari','PE','Rua 2'),
  (DEFAULT,'Libby Araujo','F','odio.etiam@hotmail.couk','32-78945-1234','35731-771','Olinda','SP','Rua 3'),
  (DEFAULT,'Scarlet Gonzaga','F','tincidunt.nunc@outlook.com','56-68943-6746','55581-274','Campos dos Goytacazes','PE','Rua 8'),
  (DEFAULT,'Velma Galdino','F','mollis.vitae@hotmail.net','56-85376-9892','58486-263','Jaboatao dos Guararapes','MG','Rua 4'),
  (DEFAULT,'Ava Diniz','F','blandit@protonmail.ca','89141-433','88-23474-9575','Niterói','SP','Rua 5'),
  (DEFAULT,'Hayes de Lourdes','F','ut.sagittis@yahoo.com','86-57824-9966','96838-726','Sao Joao de Meriti','BA','Rua 6'),
  (DEFAULT,'Isabella Fagundes','F','nisi.sem@yahoo.com','96-34623-9867','13057-693','Sao Joao de Meriti','SP','Rua 7'),
  (DEFAULT,'Cyrus de Sousa','M','sed.dictum@protonmail.ca','76-35623-9563','24814-902','Londrina','PR','Rua 9'),
  (DEFAULT,'Elvis Rezende','M','commodo.hendrerit@icloud.com','45-78346-9885','75732-571','Florianópolis','PE','Rua 10');

INSERT INTO p_funcionario (codigo,data_contrato,salario,senha_hash)
VALUES
  (4,'2022-11-15',46734.76,'$2y$10$AOSgohSGeM/n4jj.YQljDeVoujX876hvyIzA13JfOVUX.g1bqQtZq'),
  (5,'2022-10-13',3234.76,'$2y$10$AOSgohSGeM/n4jj.YQljDeVoujX876hvyIzA13JfOVUX.g1bqQtZq'),
  (6,'2021-05-04',14354.65,'$2y$10$AOSgohSGeM/n4jj.YQljDeVoujX876hvyIzA13JfOVUX.g1bqQtZq'),
  (7,'2022-06-29',2346.76,'$2y$10$AOSgohSGeM/n4jj.YQljDeVoujX876hvyIzA13JfOVUX.g1bqQtZq'),
  (8,'2021-06-21',3445.87,'$2y$10$AOSgohSGeM/n4jj.YQljDeVoujX876hvyIzA13JfOVUX.g1bqQtZq'),
  (9,'2022-12-07',4532.76,'$2y$10$AOSgohSGeM/n4jj.YQljDeVoujX876hvyIzA13JfOVUX.g1bqQtZq'),
  (10,'2022-02-01',1045.56,'$2y$10$AOSgohSGeM/n4jj.YQljDeVoujX876hvyIzA13JfOVUX.g1bqQtZq');

INSERT INTO p_medico (codigo,crm,especialidade)
VALUES
  (4,'3613019','cardiologia'),
  (5,'2102943','cardiologia'),
  (6,'8946391','cardiologia'),
  (7,'1951686','oftalmologia'),
  (8,'3886343','oftalmologia'),
  (9,'9785472','otorrinolaringologista');

INSERT INTO p_paciente (codigo,peso,altura,tipo_sanguineo)
VALUES
  (1,73.4,1.76,'ab+'),
  (2,89.2,1.87,'o-'),
  (3,69.5,1.57,'b-');

INSERT INTO p_agenda (codigo,p_data,horario,nome,sexo,email,codigo_medico)
VALUES
  (DEFAULT,'2021-03-16','8','Susan','F','susan@mail.com',4),
  (DEFAULT,'2021-03-16','12','Zezin','M','zezin@mail.com',4),
  (DEFAULT,'2021-03-16','16','Jenifer','F','jenifer@mail.com',4),
  (DEFAULT,'2021-03-20','9','Thomas','M','thomas@mail.com',9),
  (DEFAULT,'2021-03-20','10','Susan','F','susan@mail.com',9),
  (DEFAULT,'2021-03-20','11','Susan','F','susan@mail.com',8),
  (DEFAULT,'2021-03-20','9','Thomas','M','thomas@mail.com',5),
  (DEFAULT,'2021-03-25','8','Thomas','M','thomas@mail.com',7),
  (DEFAULT,'2021-03-25','15','Susan','F','susan@mail.com',7),
  (DEFAULT,'2021-03-29','8','Jessica','F','jessica@mail.com',6);