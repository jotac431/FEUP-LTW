-- Create the Users table
CREATE TABLE Users (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    role TEXT NOT NULL CHECK (role IN ('client', 'agent', 'admin'))
);

-- Create the Departments table
CREATE TABLE Departments (
    dept_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL UNIQUE
);

-- Create the Tickets table
CREATE TABLE Tickets (
    ticket_id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER NOT NULL REFERENCES Users(user_id),
    agent_id INTEGER REFERENCES Users(user_id),
    dept_id INTEGER NOT NULL REFERENCES Departments(dept_id),
    subject TEXT NOT NULL,
    description TEXT NOT NULL,
    status TEXT NOT NULL CHECK (status IN ('open', 'assigned', 'closed')),
    created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Create the Comment table
CREATE TABLE Comment (
    comment_id INTEGER PRIMARY KEY AUTOINCREMENT,
    ticket_id INTEGER NOT NULL REFERENCES Ticket(ticket_id),
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    text TEXT NOT NULL,
    created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Create the FAQ table
CREATE TABLE FAQ (
    faq_id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL UNIQUE,
    answer TEXT NOT NULL
);


INSERT INTO Users (username, password, name, email, role) 
VALUES ('client1', '12345', 'Client1', 'client1@email.com', 'client');
INSERT INTO Users (username, password, name, email, role) 
VALUES ('john_doe', '12345', 'John Doe', 'johndoe@email.com', 'client');
INSERT INTO Users (username, password, name, email, role) 
VALUES ('agent1', '12345', 'Agent1', 'agent1@email.com', 'agent');


INSERT INTO Departments (name)
VALUES ('LTW');
INSERT INTO Departments (name)
VALUES ('ChatGPT');
INSERT INTO Departments (name)
VALUES ('Other');


INSERT INTO Tickets (client_id, agent_id, dept_id, subject, description, status) 
VALUES ('1', '3', '1', 'I do not understand PHP', 'The subject is too dificult', 'open');
INSERT INTO Tickets (client_id, agent_id, dept_id, subject, description, status) 
VALUES ('1', '3', '2', 'Use of ChatGPT', 'Can not live without it', 'open');
INSERT INTO Tickets (client_id, agent_id, dept_id, subject, description, status) 
VALUES ('1', '3', '3', 'I have a lot of questions, what can i do to fix it?', '????????', 'open');

