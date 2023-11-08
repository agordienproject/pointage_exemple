from cryptography.fernet import Fernet

# Générez une clé de chiffrement
def generate_key():
    key = Fernet.generate_key()
    return key

# Chiffrez un nombre avec la clé
def encrypt_number(key, number):
    f = Fernet(key)
    encrypted_number = f.encrypt(str(number).encode())
    return encrypted_number

# Déchiffrez un nombre avec la clé
def decrypt_number(key, encrypted_number):
    f = Fernet(key)
    decrypted_number = int(f.decrypt(encrypted_number).decode())
    return decrypted_number

# Exemple d'utilisation
key = 'HrrUcJXy2netdMivAh_CXA69nu_HOJ0y-dRVtLlb1EM=='  # Génère une clé de chiffrement
number_to_encrypt = 1  # Remplacez par le nombre que vous souhaitez chiffrer

# Chiffrez le nombre
encrypted_number = encrypt_number(key, number_to_encrypt)

# Affichez le nombre chiffré
print("Nombre chiffré:", encrypted_number)

# Déchiffrez le nombre
decrypted_number = decrypt_number(key, encrypted_number)

# Affichez le nombre déchiffré
print("Nombre déchiffré:", decrypted_number)
