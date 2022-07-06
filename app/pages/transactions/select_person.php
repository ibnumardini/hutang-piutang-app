<div class="container">
    <div class="row">
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="/app/index.php?page=transactions&view=<?=$where?>"><?=$title?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pilih Orang</li>
                </ol>
            </nav>
            <h1 class="mb-3">Pilih Orang</h1>
            <div class="btn-group mb-4" role="group" aria-label="Select Person">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"
                    :checked="select_person === 'new'" @click="changeSelectPerson('new')">
                <label class="btn btn-outline-primary" for="btnradio2">Orang Baru</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                    :checked="select_person === 'fav'" @click="changeSelectPerson('fav')">
                <label class="btn btn-outline-primary" for="btnradio1">Orang Favorit</label>

            </div>
            <?= view_alert() ?>
            <div class="card">
                <div class="card-body">
                    <form :class="{ show: select_person === 'fav', hide: select_person !== 'fav' }">
                        <input type="hidden" name="page" value="transactions">
                        <input type="hidden" name="view" value="<?=$where?>">
                        <div class="mb-3">
                            <label for="person_id" class="form-label">Orang favorit</label>
                            <select class="form-select" id="person_id" name="person_id" v-model="person_id">
                                <option value="0">Pilih orang favorit</option>
                                <?php foreach ($persons as $person): ?>
                                <option value="<?=$person['id']?>"><?=$person['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <input type="hidden" name="action" value="create">
                        <button type="submit" class="btn btn-primary" :disabled="person_id === '' || person_id === 0">
                            Buat <?=$title?>
                        </button>
                    </form>
                    <form method="post" class="hide"
                        :class="{ show: select_person === 'new', hide: select_person !== 'new' }">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="newPersonHelp" value="<?= $name ?? '' ?>" >
                            <div id="newPersonHelp" class="form-text">Masukan nama orang baru.</div>
                        </div>
                        <div class="mb-3">
                            <label for="wa_num" class="form-label">Nomor Whatsapp</label>
                            <input type="number" class="form-control" id="wa_num" name="wa_num" aria-describedby="waNumHelp" value="<?= $wa_num ?? '' ?>">
                            <div id="waNumHelp" class="form-text">Masukan No. Whatsapp.</div>
                        </div>
                        <input type="hidden" name="action" value="create_person">
                        <button type="submit" class="btn btn-primary">Buat <?=$title?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>