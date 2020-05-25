<style media="screen">
    #modalContacts select,
    #modalContacts input {
        width: 100%;
        border: none;
        color: #747474;
        font-weight: 600;
        appearance: none;
        padding: 7px 12px;
        border-radius: 5px;
        -moz-appearance: none;
        -webkit-appearance: none;
        background-color: #EAEAEA;
        transition: 0.3s ease-in-out;
    }

    #modalContacts select {
        cursor: pointer;
    }

    #modalContacts select:focus,
    #modalContacts input:focus {
        outline: 0;
        color: #495057;
        border-color: #80bdff;
        background-color: #fff;
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
    }

    #modalContacts #error {
        color: #e3342f;
        font-size: 10pt;
        display: inherit;
        margin-bottom: 10px;
    }

    #modalContacts p {
        font-weight: 700;
        margin-bottom: 0;
    }

    #modalContacts .charge-div {
        margin-top: 20px;
        padding: 12px 10px;
        border-radius: 10px;
        background-color: #fff;
        transition: 0.1s ease-in-out;
    }

    #modalContacts .charge-div:hover {
        background-color: rgb(235, 235, 235);
    }

    #modalContacts .white-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
    }

    #modalContacts .white-circle img {
        border-radius: 50%;
    }

    #modalContacts a {
        color: #747474;
    }

    #modalContacts a:hover {
        color: #747474;
        text-decoration: none;
    }
</style>

<div class="modal fade bd-example-modal-lg" id="modalContacts" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom:0px;">
                <h5 class="modal-title text-center" id="modalLabel">Procura de contactos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-contact" method="POST" class="mt-2">
                <div class="modal-body" id="modal-body-contact">
                    <div class="row" id="contact-row">
                        <div class="col-md-4">
                            <label for="user-type">Tipo de contacto:</label>
                            <br>
                            <select id="user-type" name="usertype">
                                <option disabled hidden selected>Escolher tipo de utilizador</option>
                                <option value="clientes">Clientes</option>
                                <option value="agentes">Agentes</option>
                                <option value="universidades">Universidades</option>
                                <option value="fornecedores">Fornecedores</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="a-close-modal" class="mr-4" data-dismiss="modal">Fechar</a>
                    <button id="submit-button" type="submit" class="btn">Procurar contacto</button>
                </div>
            </form>
        </div>
    </div>
</div>
