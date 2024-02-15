<?PHP
class produit
{
  private $idProduit = null;
  private $nomproduit = null;
  private $typeprod = null;
  private $prix = null;
  private $stock = null;
  private $codeBarre = null;
  private $status = null;

  function __construct($idProduit = null, $nomproduit = null, $typeprod = null, $prix = null, $stock = null, $codeBarre = null, $status = null)
  {
    $this->idProduit = $idProduit;
    $this->nomproduit = $nomproduit;
    $this->typeprod = $typeprod;
    $this->prix = $prix;
    $this->stock = $stock;
    $this->codeBarre = $codeBarre;
    $this->status = $status;
  }

  function setid($idProduit)
  {
    $this->idProduit = $idProduit;
  }
  function senom($nomproduit)
  {
    $this->nomproduit = $nomproduit;
  }

  function settype($typeprod)
  {
    $this->typeprod = $typeprod;
  }
  function setprix($prix)
  {
    $this->prix = $prix;
  }
  function setstock($stock)
  {
    $this->stock = $stock;
  }

  function setcode($codeBarre)
  {
    $this->codeBarre = $codeBarre;
  }

  function setstatus($status)
  {
    $this->status = $status;
  }

  function getnom()
  {
    return $this->nomproduit;
  }

  function getid()
  {
    return $this->idProduit;
  }

  function gettype()
  {
    return $this->typeprod;
  }

  function getprix()
  {
    return $this->prix;
  }

  function getstock()
  {
    return $this->stock;
  }

  function getcode()
  {
    return $this->codeBarre;
  }

  function getstatus()
  {
    return $this->status;
  }
}
