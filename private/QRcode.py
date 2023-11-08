import cv2
from pyzbar.pyzbar import decode
from cryptography.fernet import Fernet

# Clé de chiffrement (gardez-la secrète)
encryption_key = b'HrrUcJXy2netdMivAh_CXA69nu_HOJ0y-dRVtLlb1EM=='

# Fonction pour déchiffrer une valeur chiffrée avec la clé
def decrypt_number(encryption_key, encrypted_value):
    f = Fernet(encryption_key)
    decrypted_number = int(f.decrypt(encrypted_value).decode())
    return decrypted_number

# Fonction pour lire un QR code depuis la caméra en direct et le déchiffrer
def read_and_decrypt_qr_code(encryption_key):
    cap = cv2.VideoCapture(0)  # Utilisez 0 pour la webcam par défaut
    scanning = True  # Variable pour contrôler la boucle de scan

    while scanning:
        ret, frame = cap.read()

        if not ret:
            continue

        # Décoder le QR code depuis la caméra
        decoded_objects = decode(frame)

        if decoded_objects:
            for obj in decoded_objects:
                encrypted_value = obj.data
                print("Données du QR code chiffré:", encrypted_value)
                decrypted_value = decrypt_number(encryption_key, encrypted_value)
                print("Données du QR code déchiffré:", decrypted_value)
                scanning = False  # Arrêtez le scan après avoir trouvé un QR code

        cv2.imshow('QR Code Scanner', frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    cap.release()
    cv2.destroyAllWindows()

# Utilisation de la fonction pour lire un QR code depuis la caméra en direct et le déchiffrer
read_and_decrypt_qr_code(encryption_key)
