import cv2
from pyzbar.pyzbar import decode
from cryptography.fernet import Fernet
import mysql.connector
import datetime
from tkinter import *
from tkinter import ttk
import threading

# Clé de chiffrement (gardez-la secrète)
encryption_key = b'HrrUcJXy2netdMivAh_CXA69nu_HOJ0y-dRVtLlb1EM=='

# Configuration de la connexion à la base de données MySQL
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': 'Grillon.2003',
    'database': 'pointage'
}

# Fonction pour déchiffrer une valeur chiffrée avec la clé
def decrypt_number(encryption_key, encrypted_value):
    f = Fernet(encryption_key)
    decrypted_number = int(f.decrypt(encrypted_value).decode())
    return decrypted_number

def update_info_label(text):
    info_label.config(text=text)

# Fonction pour gérer la présence
def manage_presence(conn, cursor, id_eleve):
    # Assurez-vous de valider et d'appliquer les modifications à la base de données
    conn.commit()
    print("entrée dans manage_presence")
    # Obtenez la date actuelle
    current_date = datetime.date.today()

    # Obtenez l'heure actuelle
    now = datetime.datetime.now().time()

    # Recherchez si l'élève a déjà une entrée de présence pour aujourd'hui
    cursor.execute("SELECT * FROM presence WHERE id_eleve = %s AND jour = %s", (id_eleve, current_date))
    presence_record = cursor.fetchone()

    # Si l'élève n'a pas encore de présence enregistrée pour aujourd'hui
    if presence_record is None:
        if now >= datetime.time(7, 0) and now <= datetime.time(12, 0):
            cursor.execute("INSERT INTO presence (id_eleve, jour, presence_matin, heure_matin, presence_aprem) VALUES (%s, %s, 1, %s, 0)", (id_eleve, current_date, now))
            update_info_label("Vous vous êtes enregistré ce matin à " + str(now))

        elif now >= datetime.time(13, 0) and now <= datetime.time(20, 0):
            cursor.execute("INSERT INTO presence (id_eleve, jour, presence_matin, presence_aprem, heure_aprem) VALUES (%s, %s, 0, 1, %s)", (id_eleve, current_date, now))
            update_info_label("Vous vous êtes enregistré cet après-midi à " + str(now))

    else:
        # L'élève a déjà une entrée de présence pour aujourd'hui
        if now >= datetime.time(7, 0) and now <= datetime.time(12, 0):
            if presence_record[2] == 0:
                cursor.execute("UPDATE presence SET presence_matin = 1, heure_matin = %s WHERE id_presence = %s", (now, presence_record[0]))
                update_info_label("Vous vous êtes enregistré ce matin à " + str(now))
            else:
                update_info_label("Vous vous êtes déjà enregistré ce matin.")

        elif now >= datetime.time(13, 0) and now <= datetime.time(20, 0):
            if presence_record[5] == 0:
                cursor.execute("UPDATE presence SET presence_aprem = 1, heure_aprem = %s WHERE id_presence = %s", (now, presence_record[0]))
                update_info_label("Vous vous êtes enregistré cet après-midi à " + str(now))
            else:
                update_info_label("Vous vous êtes déjà enregistré cet après-midi.")

    # Assurez-vous de valider et d'appliquer les modifications à la base de données
    conn.commit()

# Fonction pour lire un QR code depuis la caméra en direct et gérer la présence
def read_and_manage_presence(encryption_key, info_label):
    cap = cv2.VideoCapture(0)  # Utilisez 0 pour la webcam par défaut

    # Établir une connexion à la base de données
    try:
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()
        qr_code_detected = False  # Variable pour suivre si un QR code a été détecté

        while not qr_code_detected:
            ret, frame = cap.read()

            if not ret:
                continue

            # Décoder le QR code depuis la caméra
            decoded_objects = decode(frame)

            if decoded_objects:
                for obj in decoded_objects:
                    encrypted_value = obj.data
                    decrypted_value = decrypt_number(encryption_key, encrypted_value)

                    # Gérer la présence
                    manage_presence(conn, cursor, decrypted_value)

                    # Mettez à jour info_label dans la fenêtre tkinter
                    info_label.config(text="Scannez votre QR code...")

                    qr_code_detected = True  # Marquez qu'un QR code a été détecté

            cv2.imshow('QR Code Scanner', frame)

            if cv2.waitKey(1) & 0xFF == ord('q'):
                break

        cap.release()
        cv2.destroyAllWindows()

    except mysql.connector.Error as err:
        update_info_label("Erreur MySQL: " + str(err))
    finally:
        if 'conn' in locals() and conn.is_connected():
            cursor.close()
            conn.commit()
            conn.close()

# Créez une fenêtre Tkinter
root = Tk()
frm = ttk.Frame(root, padding=10)
frm.grid()

# Créez une étiquette pour afficher les informations
info_label = ttk.Label(frm, text="Veuillez scanner votre QR code")
info_label.grid(column=0, row=0)

# Lancez le lecteur de QR code en arrière-plan
qr_thread = threading.Thread(target=read_and_manage_presence, args=(encryption_key, info_label))
qr_thread.start()

root.mainloop()
