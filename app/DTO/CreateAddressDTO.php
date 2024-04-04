<?php 

namespace App\DTO;

class CreateAddressDTO
{
    public function __construct(
        public string $cep,
        public string $logradouro,
        public string $complemento,
        public string $bairro,
        public string $localidade,
        public string $uf,
        public string $ddd,
    ){ }
}

?>