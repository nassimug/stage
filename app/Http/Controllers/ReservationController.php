<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Equipement;
use Carbon\Carbon;
class ReservationController extends Controller
{

private function formatDates($reservation)
{
    return [
        'formattedDateDebut' =>  Carbon::parse($reservation->date_debut)->format('d/m/Y') ,
        'formattedDateFin' => Carbon::parse($reservation->date_fin)->format('d/m/Y') ,
    ];
}
    public function index()
    {
        $request = request();  // Utiliser la fonction helper de Laravel pour récupérer la requête globalement
        $status = $request->query('status');

        if (auth()->user()->role === 'admin') {
            $query = Reservation::with('equipement');
            if (!empty($status)) {
                $query = $query->where('statut', $status);
            }
            $reservations = $query->paginate(8);
        } else {
            $query = Reservation::where('user_id', auth()->id())->with('equipement');
            if (!empty($status)) {
                $query = $query->where('statut', $status);
            }
            $reservations = $query->paginate(8);
        }
        foreach ($reservations as $reservation) {
        $formattedDates = $this->formatDates($reservation);
        $reservation->formattedDateDebut = $formattedDates['formattedDateDebut'];
        $reservation->formattedDateFin = $formattedDates['formattedDateFin'];
    }


        return view('reservations.index', compact('reservations'));
    }




    public function create($equipementId)
    {
        $equipement = Equipement::findOrFail($equipementId); // Assurez-vous que l'équipement existe
        return view('reservations.create', compact('equipement'));
    }


    public function store(Request $request)
{
    // Règles de validation
    $rules = [
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'equipement_id' => 'required|exists:equipements,id'
    ];

    // Messages d'erreur personnalisés
    $messages = [
        'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        'date_debut.after_or_equal' => 'La date de début doit être aujourd’hui ou une date future.',
    ];

    // Exécution de la validation
    $request->validate($rules, $messages);

    // Récupération des informations de l'utilisateur connecté
    $user = auth()->user();

    // Création de la réservation
    Reservation::create([
        'nom' => $user->nom,
        'prenom' => $user->prenom,
        'email' => $user->email,
        'identifiant' => $user->login,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'equipement_id' => $request->equipement_id,
        'user_id' => $user->id
    ]);

    return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
}





    public function show(Reservation $reservation)
    {
        // Vérifiez si l'utilisateur est admin ou le créateur de la réservation
        if (auth()->user()->role !== 'admin' && auth()->id() !== $reservation->user_id) {
            abort(403);
        }

        $formattedDateDebut = Carbon::parse($reservation->date_debut)->format('d/m/Y');
        $formattedDateFin = Carbon::parse($reservation->date_fin)->format('d/m/Y');

        return view('reservations.show', compact('reservation', 'formattedDateDebut', 'formattedDateFin'));
    }




    public function destroy(Reservation $reservation)
    {
        // Vérifiez si l'utilisateur est admin ou le créateur de la réservation
        if (auth()->user()->role !== 'admin' && auth()->id() !== $reservation->user_id) {
            abort(403);
        }

        $reservation->delete();
        return back()->with('success', 'Reservation deleted successfully.');
    }

    public function accept(Request $request, Reservation $reservation)
    {
        // Vérifiez si l'utilisateur est un administrateur
        if (auth()->user()->role !== 'admin') {
        abort(403); // Accès refusé
        }
        // Mettez à jour l'état de la réservation pour marquer comme acceptée
        $reservation->update([
        'statut' => 'accepted',
        'commentaire' => $request->commentaire, 
        ]);
        // Redirigez l'utilisateur vers la page de détails de la réservation
        return redirect()->route('reservations.index', $reservation->id)->with('success',
        'Réservation acceptée avec succès.');
        }

    public function reject(Request $request, Reservation $reservation)
    {

        // Vérifiez si l'utilisateur est un administrateur
        if (auth()->user()->role !== 'admin') {
        abort(403); // Accès refusé
        }
        // Mettez à jour l'état de la réservation pour marquer comme refusée
        $reservation->update([
        'statut' => 'rejected',
        'commentaire' => $request->commentaire, 
        ]);
        // Redirigez l'utilisateur vers la page de détails de la réservation
        return redirect()->route('reservations.index', $reservation->id)->with('success',
        'Réservation refusée avec succès.');
    }

    public function showAcceptForm(Reservation $reservation)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }
    return view('reservations.accept', compact('reservation'));
}

public function showRejectForm(Reservation $reservation)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }
    return view('reservations.reject', compact('reservation'));
}


}
