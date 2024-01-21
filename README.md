# BookHub: Library Reservation System

Users and Librarians (Users):

Attributes:
id (primary key, auto-incremented)
name (full name of the user)
email (unique email address for login)
password (hashed and salted password for security)
role_id (foreign key to Roles, determining user type - 'User' or 'Librarian')

Roles:

Attributes:
id (primary key, auto-incremented)
name (role name, e.g., 'User' or 'Librarian')

Permissions:

Attributes:
id (primary key, auto-incremented)
name (name of the permission, e.g., 'CanReserve', 'CanCancelReservation')
Books:

Attributes:
id (primary key, auto-incremented)
title (title of the book)
author (name of the author)
isbn (International Standard Book Number)
category (genre or category of the book)
availability (boolean indicating whether the book is currently available)
Reservations:

Attributes:
id (primary key, auto-incremented)
user_id (foreign key to Users)
book_id (foreign key to Books)
reservation_date (date when the reservation was made)
pickup_deadline (date until which the book should be picked up)
is_active (boolean indicating whether the reservation is active or not)