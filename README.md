# Projet_Cinema

lien word : https://lyceerobertschuman710-my.sharepoint.com/:w:/r/personal/t_enfedaque_lprs_fr/Documents/Trucs%20utiles.docx?d=w3833bdf1a5de409aabf78f7276d680c0&csf=1&web=1&e=U9ULHR

lien Projet Github : https://github.com/users/Nico180803/projects/1

utilisateur = (id_user INT, nom VARCHAR(50), prenom VARCHAR(50), email VARCHAR(50), mdp VARCHAR(50), role VARCHAR(50));
Reservation = (id_reservation INT, nb_place INT, ref_user INT, ref_seance INT, prix DECIMAL(15,2));
Seance = (id_seance INT, date_seance DATE, heure TIME, ref_salle VARCHAR(50), nb_place_dispo INT);
Salle = (id_salle INT, nb_place INT);
Film = (id_film INT, titre VARCHAR(50), resume VARCHAR(50), genre VARCHAR(50), duree TIME, image VARCHAR(50));
Contact = (id_contact VARCHAR(50), sujet VARCHAR(50), explication VARCHAR(50));
