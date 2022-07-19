<?php

namespace App\Jobs;

use Curl\Curl;
use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateWojak implements ShouldQueue
{
    use Dispatchable, ImportsCards, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Curl
     *
     * @var \Curl\Curl
     */
    protected $curl;

    /**
     * Collection
     *
     * @var \App\Collection
     */
    protected $collection;

    /**
     * Override Existing Images
     *
     * @var boolean
     */
    protected $override;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $collection, $override = false)
    {
        $this->collection = $collection;
        $this->override = $override;
        $this->curl = new Curl();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Wojak URLs
        $urls = $this->getURLs();

        foreach($urls as $api) {

            // Wojak API
            $data = $this->getAPI($api);

            if(!isset($data['asset_name'])) continue;

            // Simple Guards
            if (in_array($data['asset_name'], ['BITCORN', 'BTC', 'XCP', 'PEPECASH'])) {
                continue;
            }

            // The Asset
            $xcp_core_asset_name = $this->getAssetName($data['asset_name']);

            // Image URL
            $image_url = $this->getImageUrl($data['image_large'], $this->override);

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $data['asset_name'], $data);

            // Relation
            $card->collections()->syncWithoutDetaching([$this->collection->id => ['image_url' => $image_url]]);
        }
    }

    private function getURLs()
    {
        return [
            "https://thewojakway.com/j/BADWOJAK.json",
            "https://thewojakway.com/j/BOBWOJAK.json",
            "https://thewojakway.com/j/BOUNCINOGGIN.json",
            "https://thewojakway.com/j/CIPHERWOJAK.json",
            "https://thewojakway.com/j/CMYKWOJAK.json",
            "https://thewojakway.com/j/CRUNKWOJAK.json",
            "https://thewojakway.com/j/CUBISMWOJAK.json",
            "https://thewojakway.com/j/DAWOJAK.json",
            "https://thewojakway.com/j/DJWOJAK.json",
            "https://thewojakway.com/j/DREJAK.json",
            "https://thewojakway.com/j/EDWARDJAK.json",
            "https://thewojakway.com/j/FEELSBRIEF.json",
            "https://thewojakway.com/j/FIGHTNIGHT.json",
            "https://thewojakway.com/j/GAMESOFWOJAK.json",
            "https://thewojakway.com/j/GRIMJAK.json",
            "https://thewojakway.com/j/HAWT.json",
            "https://thewojakway.com/j/HECTICWOJAK.json",
            "https://thewojakway.com/j/IAMSELLING.json",
            "https://thewojakway.com/j/JAKATOM.json",
            "https://thewojakway.com/j/JAKSPARROW.json",
            "https://thewojakway.com/j/JANVANWOJAK.json",
            "https://thewojakway.com/j/lichtenstein.json",
            "https://thewojakway.com/j/MARKETWOJAK.json",
            "https://thewojakway.com/j/MEMESTREET.json",
            "https://thewojakway.com/j/METAVERSED.json",
            "https://thewojakway.com/j/MODERNWOJAK.json",
            "https://thewojakway.com/j/NATTOPENPEN.json",
            "https://thewojakway.com/j/NEWTONSWOJAK.json",
            "https://thewojakway.com/j/NIETZSCHEWOJ.json",
            "https://thewojakway.com/j/NOJAK.json",
            "https://thewojakway.com/j/NPCWOJAK.json",
            "https://thewojakway.com/j/OPENMIND.json",
            "https://thewojakway.com/j/PEJAK.json",
            "https://thewojakway.com/j/PEONTRUST.json",
            "https://thewojakway.com/j/PETTHEDOG.json",
            "https://thewojakway.com/j/PICASSOJAK.json",
            "https://thewojakway.com/j/POWELLWOJAK.json",
            "https://thewojakway.com/j/PROOFOFWOJAK.json",
            "https://thewojakway.com/j/RAMJAK.json",
            "https://thewojakway.com/j/RAREWOJAK.json",
            "https://thewojakway.com/j/RICHWOJAK.json",
            "https://thewojakway.com/j/SATOSHIJAK.json",
            "https://thewojakway.com/j/SHOWJAK.json",
            "https://thewojakway.com/j/SILKROADS.json",
            "https://thewojakway.com/j/SLOWJAK.json",
            "https://thewojakway.com/j/SMOLWOJAK.json",
            "https://thewojakway.com/j/THEGRIND.json",
            "https://thewojakway.com/j/THESIMJAK.json",
            "https://thewojakway.com/j/TOUPEEWOJAK.json",
            "https://thewojakway.com/j/TRENDING.json",
            "https://thewojakway.com/j/TWINWOJAK.json",
            "https://thewojakway.com/j/UNKNOWNWOJAK.json",
            "https://thewojakway.com/j/VALAKWOJAK.json",
            "https://thewojakway.com/j/VANWOJAKGOGH.json",
            "https://thewojakway.com/j/VITRUVIANWOJ.json",
            "https://thewojakway.com/j/WISSILE.json",
            "https://thewojakway.com/j/WOAHWOJAK.json",
            "https://thewojakway.com/j/WOBLOBFISH.json",
            "https://thewojakway.com/j/WOHEALING.json",
            "https://thewojakway.com/j/WOILLUSIONS.json",
            "https://thewojakway.com/j/WOJABSTRAKT.json",
            "https://thewojakway.com/j/WOJAKA.json",
            "https://thewojakway.com/j/WOJAKALIEN.json",
            "https://thewojakway.com/j/WOJAKANANA.json",
            "https://thewojakway.com/j/WOJAKANGEL.json",
            "https://thewojakway.com/j/WOJAKARAMBE.json",
            "https://thewojakway.com/j/WOJAKARENHUT.json",
            "https://thewojakway.com/j/WOJAKARMY.json",
            "https://thewojakway.com/j/WOJAKASS.json",
            "https://thewojakway.com/j/WOJAKBANKSY.json",
            "https://thewojakway.com/j/WOJAKBARTO.json",
            "https://thewojakway.com/j/WOJAKBOOM.json",
            "https://thewojakway.com/j/WOJAKCASSO.json",
            "https://thewojakway.com/j/WOJAKCHAMPNS.json",
            "https://thewojakway.com/j/WOJAKCHU.json",
            "https://thewojakway.com/j/WOJAKCOPY.json",
            "https://thewojakway.com/j/WOJAKCRASH.json",
            "https://thewojakway.com/j/WOJAKFAKE.json",
            "https://thewojakway.com/j/WOJAKFALLON.json",
            "https://thewojakway.com/j/WOJAKFORMULA.json",
            "https://thewojakway.com/j/WOJAKFUTURE.json",
            "https://thewojakway.com/j/WOJAKGASBOB.json",
            "https://thewojakway.com/j/WOJAKGOTHIC.json",
            "https://thewojakway.com/j/WOJAKHAREM.json",
            "https://thewojakway.com/j/WOJAKINABOX.json",
            "https://thewojakway.com/j/WOJAKINJAPAN.json",
            "https://thewojakway.com/j/WOJAKISFINE.json",
            "https://thewojakway.com/j/WOJAKKISAKI.json",
            "https://thewojakway.com/j/WOJAKLAND.json",
            "https://thewojakway.com/j/WOJAKLISA.json",
            "https://thewojakway.com/j/WOJAKLOPEZ.json",
            "https://thewojakway.com/j/WOJAKLORD.json",
            "https://thewojakway.com/j/WOJAKLOVERS.json",
            "https://thewojakway.com/j/WOJAKMINER.json",
            "https://thewojakway.com/j/WOJAKNDOWSKI.json",
            "https://thewojakway.com/j/WOJAKNOID.json",
            "https://thewojakway.com/j/WOJAKO.json",
            "https://thewojakway.com/j/WOJAKOMET.json",
            "https://thewojakway.com/j/WOJAKPAIN.json",
            "https://thewojakway.com/j/WOJAKPAINT.json",
            "https://thewojakway.com/j/WOJAKPANIC.json",
            "https://thewojakway.com/j/WOJAKPARTY.json",
            "https://thewojakway.com/j/WOJAKPIGGY.json",
            "https://thewojakway.com/j/WOJAKPIXEL.json",
            "https://thewojakway.com/j/WOJAKRARE.json",
            "https://thewojakway.com/j/WOJAKSAD.json",
            "https://thewojakway.com/j/WOJAKSCREAM.json",
            "https://thewojakway.com/j/WOJAKSENSHI.json",
            "https://thewojakway.com/j/WOJAKSLAP.json",
            "https://thewojakway.com/j/WOJAKSONS.json",
            "https://thewojakway.com/j/WOJAKSSUPPER.json",
            "https://thewojakway.com/j/WOJAKSTAR.json",
            "https://thewojakway.com/j/WOJAKTARIST.json",
            "https://thewojakway.com/j/WOJAKTHEFOOL.json",
            "https://thewojakway.com/j/WOJAKTRADING.json",
            "https://thewojakway.com/j/WOJAKUNGSTEN.json",
            "https://thewojakway.com/j/WOJAKVERMEER.json",
            "https://thewojakway.com/j/WOJAKWAYBETS.json",
            "https://thewojakway.com/j/WOJAKWHALE.json",
            "https://thewojakway.com/j/WOJAKWII.json",
            "https://thewojakway.com/j/WOJAKWIZARD.json",
            "https://thewojakway.com/j/WOJAKWORDART.json",
            "https://thewojakway.com/j/WOJAKZILLA.json",
            "https://thewojakway.com/j/wojcharlotte.json",
            "https://thewojakway.com/j/WOJHALEN.json",
            "https://thewojakway.com/j/WOJHODL.json",
            "https://thewojakway.com/j/WOJILLVILLE.json",
            "https://thewojakway.com/j/WOJINX.json",
            "https://thewojakway.com/j/WOJOKER.json",
            "https://thewojakway.com/j/WOJTOTER.json",
            "https://thewojakway.com/j/WOLATTE.json",
            "https://thewojakway.com/j/WOLITAXPRESS.json",
            "https://thewojakway.com/j/WORRYONETTE.json",
            "https://thewojakway.com/j/WOSOCHILL.json",
            "https://thewojakway.com/j/XXXWOJAK.json",
            "https://thewojakway.com/j/YGGWOJAK.json",
            "https://thewojakway.com/j/YOURASSET.json",
            "https://thewojakway.com/j/ZZZORDON.json",
        ];
    }

    /**
     * Get API
     *
     * @return array
     */
    private function getAPI($url)
    {
        // Get API
        $this->curl->get($url);

        // API Error
        if ($this->curl->error) {
            return [];
        }

        // Response
        return json_decode($this->curl->response, true);
    }
}
