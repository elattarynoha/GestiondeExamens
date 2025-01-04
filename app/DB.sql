Create database GestionExams;

CREATE TABLE roles (
    RoleID INT AUTO_INCREMENT PRIMARY KEY,  -- Clé primaire auto-incrémentée
    RoleName VARCHAR(50) NOT NULL           -- Nom du rôle, obligatoire
);

CREATE TABLE users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,  -- Clé primaire auto-incrémentée
    CNI VARCHAR(20) NOT NULL UNIQUE,        -- CNI unique et obligatoire
    FirstName VARCHAR(50) NOT NULL,         -- Prénom obligatoire
    LastName VARCHAR(50) NOT NULL,          -- Nom obligatoire
    Birthdate DATE NOT NULL,                -- Date de naissance obligatoire
    AcademicEmail VARCHAR(100) NOT NULL,    -- Email académique obligatoire
    RoleID INT,                             -- Clé étrangère vers 'role'
    FOREIGN KEY (RoleID) REFERENCES roles(RoleID) -- Définition de la clé étrangère
);

CREATE TABLE accounts (
    AccountID INT AUTO_INCREMENT PRIMARY KEY,  -- Clé primaire auto-incrémentée
    UserID INT,                               -- Clé étrangère vers 'users'
    RoleID INT,                               -- Clé étrangère vers 'role'
    AcademicEmail VARCHAR(100) NOT NULL,      -- Email académique obligatoire
    Password VARCHAR(255) NOT NULL,           -- Mot de passe (taille ajustable selon les besoins)
    FOREIGN KEY (UserID) REFERENCES users(UserID), -- Clé étrangère vers 'users'
    FOREIGN KEY (RoleID) REFERENCES roles(RoleID)  -- Clé étrangère vers 'role'
);