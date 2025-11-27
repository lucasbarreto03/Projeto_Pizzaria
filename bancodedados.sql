-- MySQL Script gerado após adaptação de Concessionária para Pizzaria
-- Este script corrige a sintaxe (parênteses faltantes) e inclui todos os campos novos.

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- 1. CRIAÇÃO DO SCHEMA
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `barretospizza` DEFAULT CHARACTER SET utf8 ;
USE `barretospizza` ;

-- -----------------------------------------------------
-- 2. Table `cliente` (Cliente)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barretospizza`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome_cliente` VARCHAR(100) NOT NULL,
  `cpf_cliente` CHAR(11) NULL,
  `email_cliente` VARCHAR(100) NULL,
  `telefone_cliente` VARCHAR(20) NULL,
  `endereco_cliente` VARCHAR(100) NULL,
  `complemento_endereco` VARCHAR(50) NULL, 
  `dt_nasc_cliente` DATE NULL,
  PRIMARY KEY (`id_cliente`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 3. Table `entregador` (Antigo Funcionário)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barretospizza`.`entregador` (
  `id_entregador` INT NOT NULL AUTO_INCREMENT,
  `nome_entregador` VARCHAR(100) NOT NULL,
  `telefone_entregador` VARCHAR(20) NULL,
  `email_entregador` VARCHAR(100) NULL,
  `cpf_entregador` CHAR(11) NULL,
  `placa_veiculo` VARCHAR(10) NULL,
  PRIMARY KEY (`id_entregador`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 4. Table `ingrediente` (Antiga Marca)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barretospizza`.`ingrediente` (
  `id_ingrediente` INT NOT NULL AUTO_INCREMENT,
  `nome_ingrediente` VARCHAR(45) NOT NULL,
  `unidade_medida` VARCHAR(10) NULL, 
  PRIMARY KEY (`id_ingrediente`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 5. Table `pizza` (Antigo Modelo)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barretospizza`.`pizza` (
  `id_pizza` INT NOT NULL AUTO_INCREMENT,
  `nome_pizza` VARCHAR(45) NOT NULL,
  `tamanho_pizza` VARCHAR(20) NULL, 
  `preco_base` DECIMAL(10, 2) NOT NULL, 
  `categoria_pizza` VARCHAR(45) NULL,
  PRIMARY KEY (`id_pizza`) 
) 
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 6. Table `pizza_ingrediente` (JUNÇÃO N:M)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barretospizza`.`pizza_ingrediente` (
  `pizza_id` INT NOT NULL,
  `ingrediente_id` INT NOT NULL,
  `quantidade_necessaria` DECIMAL(10, 2) NULL, 
  PRIMARY KEY (`pizza_id`, `ingrediente_id`),
  CONSTRAINT `fk_pi_pizza`
    FOREIGN KEY (`pizza_id`)
    REFERENCES `barretospizza`.`pizza` (`id_pizza`)
    ON DELETE CASCADE, 
  CONSTRAINT `fk_pi_ingrediente`
    FOREIGN KEY (`ingrediente_id`)
    REFERENCES `barretospizza`.`ingrediente` (`id_ingrediente`)
    ON DELETE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 7. Table `pedido` (Antiga Venda)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barretospizza`.`pedido` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT,
  `data_pedido` DATETIME NULL, 
  `status_pedido` VARCHAR(45) NULL,
  `valor_total` DECIMAL(10,2) NULL, 
  `cliente_id_cliente` INT NOT NULL,
  `entregador_id_entregador` INT NULL, 
  PRIMARY KEY (`id_pedido`), 
  INDEX `fk_pedido_cliente1_idx` (`cliente_id_cliente` ASC),
  INDEX `fk_pedido_entregador1_idx` (`entregador_id_entregador` ASC),
  CONSTRAINT `fk_pedido_cliente1`
    FOREIGN KEY (`cliente_id_cliente`)
    REFERENCES `barretospizza`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_entregador1`
    FOREIGN KEY (`entregador_id_entregador`)
    REFERENCES `barretospizza`.`entregador` (`id_entregador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 8. Table `item_pedido` (Detalhe da Transação)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barretospizza`.`item_pedido` (
  `id_item_pedido` INT NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `pizza_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `preco_unitario` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`id_item_pedido`),
  INDEX `fk_item_pedido_pedido_idx` (`pedido_id` ASC),
  INDEX `fk_item_pedido_pizza_idx` (`pizza_id` ASC),
  CONSTRAINT `fk_item_pedido_pedido`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `barretospizza`.`pedido` (`id_pedido`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_item_pedido_pizza`
    FOREIGN KEY (`pizza_id`)
    REFERENCES `barretospizza`.`pizza` (`id_pizza`)
    ON DELETE NO ACTION
)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;