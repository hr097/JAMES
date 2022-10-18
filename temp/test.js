var encryptCredentials = (str) => { return (CryptoJS.AES.encrypt(str,str)); }        

var decryptCredentials = (str) => { return (CryptoJS.AES.decrypt(str,str.toString(CryptoJS.enc.Utf8))); }   



const enc = "Enc data : "+encryptCredentials("harshil");
console.log("Enc data : "+enc);
console.log("Dec data : "+encryptCredentials(enc));
