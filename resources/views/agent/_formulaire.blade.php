@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('agent.conges.store') }}">
    @csrf

    <div class="form-group mb-3">
        <label for="type">Type de congé <span class="text-danger">*</span></label>
        <select name="type" id="type" class="form-control" required>
            <option value="">-- Sélectionnez --</option>
            <option value="annuel">Annuel</option>
            <option value="maladie">Maladie</option>
            <option value="exceptionnel">Exceptionnel</option>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="date_debut">Date de début <span class="text-danger">*</span></label>
            <input type="date" name="date_debut" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="date_fin">Date de fin <span class="text-danger">*</span></label>
            <input type="date" name="date_fin" class="form-control" required>
        </div>
    </div>

    <div class="form-group mb-4">
        <label for="motif">Motif (facultatif)</label>
        <textarea name="motif" class="form-control" rows="3" placeholder="Détail du motif..."></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-paper-plane"></i> Soumettre la demande
    </button>
</form>
