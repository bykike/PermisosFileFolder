<?php
// Read and write for owner, nothing for everybody else
//chmod("/xxx", 0600);

// Read and write for owner, read for everybody else
// chmod("/somedir/somefile", 0644);

// Everything for owner, read and execute for others
chmod("/xxx/", 0755);

// Everything for owner, read and execute for owner's group
// chmod("/somedir/somefile", 0750);





// $permisos = fileperms('/etc/passwd');

$permisos = fileperms('/xxx');


switch ($perms & 0xF000) {
    case 0xC000: // Socket
        $info = 's';
        break;
    case 0xA000: // Enlace simbólico
        $info = 'l';
        break;
    case 0x8000: // Normal
        $info = 'r';
        break;
    case 0x6000: // Bloque especial
        $info = 'b';
        break;
    case 0x4000: // Directorio
        $info = 'd';
        break;
    case 0x2000: // Carácter especial
        $info = 'c';
        break;
    case 0x1000: // Tubería FIFO pipe
        $info = 'p';
        break;
    default: // Desconocido
        $info = 'u';
}

// Propietario
$info .= (($permisos & 0x0100) ? 'r' : '-');
$info .= (($permisos & 0x0080) ? 'w' : '-');
$info .= (($permisos & 0x0040) ?
            (($permisos & 0x0800) ? 's' : 'x' ) :
            (($permisos & 0x0800) ? 'S' : '-'));

// Grupo
$info .= (($permisos & 0x0020) ? 'r' : '-');
$info .= (($permisos & 0x0010) ? 'w' : '-');
$info .= (($permisos & 0x0008) ?
            (($permisos & 0x0400) ? 's' : 'x' ) :
            (($permisos & 0x0400) ? 'S' : '-'));

// Mundo
$info .= (($permisos & 0x0004) ? 'r' : '-');
$info .= (($permisos & 0x0002) ? 'w' : '-');
$info .= (($permisos & 0x0001) ?
            (($permisos & 0x0200) ? 't' : 'x' ) :
            (($permisos & 0x0200) ? 'T' : '-'));

echo $info;
?>
