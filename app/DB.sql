Create database GestionExams;

CREATE TABLE roles (
    RoleID INT AUTO_INCREMENT PRIMARY KEY,  -- Clé primaire auto-incrémentée
    RoleName VARCHAR(50) NOT NULL           -- Nom du rôle, obligatoire
);

CREATE TABLE users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,  -- Clé primaire auto-incrémentée
    FirstName VARCHAR(50) NOT NULL,         -- Prénom obligatoire
    LastName VARCHAR(50) NOT NULL,          -- Nom obligatoire
    AcademicEmail VARCHAR(100) NOT NULL,    -- Email académique obligatoire
    RoleID INT,                             -- Clé étrangère vers 'role'
    FOREIGN KEY (RoleID) REFERENCES roles(RoleID) -- Définition de la clé étrangère
);


-- Table des comptes
CREATE TABLE accounts (
    AccountID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    AcademicEmail VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);

-- Table des filières
CREATE TABLE filieres (
    FiliereID INT AUTO_INCREMENT PRIMARY KEY,
    NomFiliere VARCHAR(100) NOT NULL
);


-- Table des modules
CREATE TABLE modules (
    ModuleID INT AUTO_INCREMENT PRIMARY KEY,
    NomModule VARCHAR(100) NOT NULL
);

-- Table d'association Filiere_Module (relation plusieurs-à-plusieurs)
CREATE TABLE Filiere_Module (
    FiliereID INT,
    ModuleID INT,
    PRIMARY KEY (FiliereID, ModuleID),
    FOREIGN KEY (FiliereID) REFERENCES filieres(FiliereID) ON DELETE CASCADE,
    FOREIGN KEY (ModuleID) REFERENCES modules(ModuleID) ON DELETE CASCADE
);

-- Table pour lier les professeurs aux modules qu'ils enseignent
CREATE TABLE Prof_Module (
    ProfesseurID INT,
    ModuleID INT,
    PRIMARY KEY (ProfesseurID, ModuleID),
    FOREIGN KEY (ProfesseurID) REFERENCES users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (ModuleID) REFERENCES modules(ModuleID) ON DELETE CASCADE
);
