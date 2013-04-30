<?php 
global $dbserver, $dbusername, $dbpassword, $database;

$dbserver = "localhost";
$dbusername = "emeno";
$dbpassword = "[emenouser].";
$database = "emeno";

class DataEncryptor
{
    const MY_MCRYPT_CIPHER        = MCRYPT_RIJNDAEL_256;
    const MY_MCRYPT_MODE          = MCRYPT_MODE_CBC;
    const MY_MCRYPT_KEY_STRING    = "DrG4SSJjTyJyQ5k12+blJN4Dwdiqx66n6DdImwb3U3s"; // This should be a random string, recommended 32 bytes
    // const MY_MCRYPT_BASE64_IV     = "iMCYSQtMfAlLpQKrfWq6HAF3F8+uXNMRNn3XSfrHdj8="; // Selected IV base64 encoded
    const BASE64_SEPARATOR        = "|";
    
    public  $lastIv               = '';


    public function __construct()
    {
        // do nothing
    }


    /**
     * Accepts a plaintext string and returns the encrypted version
     */
    public function mcryptEncryptString( $stringToEncrypt, $base64encoded = true )
    {
        // Set the initialization vector
            $iv_size      = mcrypt_get_iv_size( self::MY_MCRYPT_CIPHER, self::MY_MCRYPT_MODE );
            $iv           = mcrypt_create_iv( $iv_size, MCRYPT_RAND );
            $this->lastIv = $iv;

        // Encrypt the data
            $encryptedData = mcrypt_encrypt( self::MY_MCRYPT_CIPHER, self::MY_MCRYPT_KEY_STRING, $stringToEncrypt , self::MY_MCRYPT_MODE , $iv );

        // Data may need to be passed through a non-binary safe medium so base64_encode it if necessary. (makes data about 33% larger)
            if ( $base64encoded ) {
                $encryptedData = base64_encode( $encryptedData );
                $this->lastIv  = base64_encode( $iv );
            } else {
                $this->lastIv = $iv;
            }

        // Return the encrypted data
            return $encryptedData . self::BASE64_SEPARATOR . $this->lastIv;
    }


    /**
     * Accepts a ciphertext string and IV and returns the decrypted version
     */
    public function mcryptDecryptString( $stringToDecrypt, $iv, $base64encoded = true )
    {
        // Note: the decryption IV must be the same as the encryption IV so the encryption IV must be stored during encryption

        // The data may have been base64_encoded so decode it if necessary (must come before the decrypt)
            if ( $base64encoded ) {
                $stringToDecrypt = base64_decode( $stringToDecrypt );
                $iv              = base64_decode( $iv );
            }

        // Decrypt the data
            $decryptedData = mcrypt_decrypt( self::MY_MCRYPT_CIPHER, self::MY_MCRYPT_KEY_STRING, $stringToDecrypt, self::MY_MCRYPT_MODE, $iv );

        // Return the decrypted data
            return rtrim( $decryptedData ); // the rtrim is needed to remove padding added during encryption
    }

    /**
     * Accepts a ciphertext string concatenated with an IV and returns the decrypted version
     */
    public function mcryptDecryptStringWithIV( $stringToDecrypt, $base64encoded = true )
    {
        // Note: the decryption IV must be the same as the encryption IV so the encryption IV must be stored during encryption

        // The data may have been base64_encoded so decode it if necessary (must come before the decrypt)
            list( $ciphertext, $iv ) = explode(self::BASE64_SEPARATOR, $stringToDecrypt);
            if ( $base64encoded ) {
                $ciphertext = base64_decode( $ciphertext );
                $iv              = base64_decode( $iv );
            }
            
        // Decrypt the data
            $decryptedData = mcrypt_decrypt( self::MY_MCRYPT_CIPHER, self::MY_MCRYPT_KEY_STRING, $ciphertext, self::MY_MCRYPT_MODE, $iv );

        // Return the decrypted data
            return rtrim( $decryptedData ); // the rtrim is needed to remove padding added during encryption
    }

}


?>