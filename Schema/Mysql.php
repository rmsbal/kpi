<?php

namespace Kanboard\Plugin\KPI\Schema;

const VERSION = 1;

function version_1($pdo)
{
    // KPI Definitions
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS kpi_definition (
            id INT AUTO_INCREMENT PRIMARY KEY,
            project_id INT NOT NULL,
            name VARCHAR(150) NOT NULL,
            description TEXT DEFAULT NULL,
            metric VARCHAR(100) NOT NULL,
            target DECIMAL(10,2) DEFAULT 0.00,
            weight DECIMAL(5,2) DEFAULT 0.00,
            period ENUM('daily','weekly','monthly','yearly') DEFAULT 'monthly',
            active TINYINT(1) DEFAULT 1,
            created_at INT NOT NULL,
            updated_at INT NOT NULL,

            INDEX(project_id)
        ) ENGINE=InnoDB;
    ");

    // KPI Assignments
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS kpi_assignment (
            id INT AUTO_INCREMENT PRIMARY KEY,
            kpi_id INT NOT NULL,
            user_id INT NOT NULL,
            project_id INT DEFAULT NULL,
            created_at INT NOT NULL,

            INDEX(kpi_id),
            INDEX(user_id),
            INDEX(project_id)
        ) ENGINE=InnoDB;
    ");

    // KPI History
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS kpi_history (
            id INT AUTO_INCREMENT PRIMARY KEY,
            project_id INT NOT NULL,
            kpi_id INT NOT NULL,
            actual_value DECIMAL(10,2) DEFAULT NULL,
            target_value DECIMAL(10,2) DEFAULT NULL,
            score DECIMAL(10,2) DEFAULT NULL,
            created_at INT NOT NULL,

            INDEX(project_id),
            INDEX(kpi_id)
        ) ENGINE=InnoDB;
    ");

    // KPI Results
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS kpi_result (
            id INT AUTO_INCREMENT PRIMARY KEY,
            kpi_id INT NOT NULL,
            user_id INT NOT NULL,
            actual DECIMAL(10,2) DEFAULT NULL,
            target DECIMAL(10,2) DEFAULT NULL,
            score DECIMAL(10,2) DEFAULT NULL,
            status VARCHAR(20) DEFAULT NULL,
            calculated_at INT DEFAULT NULL,

            INDEX(kpi_id),
            INDEX(user_id)
        ) ENGINE=InnoDB;
    ");

    // User KPI Scores
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS kpi_user_score (
            id INT AUTO_INCREMENT PRIMARY KEY,
            project_id INT DEFAULT NULL,
            user_id INT DEFAULT NULL,
            score DECIMAL(10,2) DEFAULT NULL,
            completed_tasks INT DEFAULT NULL,
            overdue_tasks INT DEFAULT NULL,
            created_at INT DEFAULT NULL,

            INDEX(project_id),
            INDEX(user_id)
        ) ENGINE=InnoDB;
    ");
}