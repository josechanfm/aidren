<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article; // Import the News model
use Illuminate\Support\Facades\Http; // Use the Http facade for checking URL availability

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // Sample news data with updated image URLs
        $articles = [
            [
                'category'=>'news',
                'title' => 'New Dispute Resolution Expert Network Launched',
                'content' => 'A new network of dispute resolution experts has been established to provide better support and guidance in conflict management.',
                'author' => 'John Doe',
                'image_url' => 'https://picsum.photos/200/300?random=1', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Training Program for Mediators Announced',
                'content' => 'A comprehensive training program for mediators is set to begin next month, aiming to enhance skills and knowledge in the field.',
                'author' => 'Jane Smith',
                'image_url' => 'https://picsum.photos/200/300?random=2', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'How to Resolve Conflicts Effectively',
                'content' => 'Experts share their insights on effective strategies for conflict resolution in various settings.',
                'author' => 'Emily Johnson',
                'image_url' => 'https://picsum.photos/200/300?random=3', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Webinar on Negotiation Techniques Scheduled',
                'content' => 'Join us for an upcoming webinar focused on advanced negotiation techniques with leading experts in the field.',
                'author' => 'Michael Brown',
                'image_url' => 'https://picsum.photos/200/300?random=4', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Annual Conference on Dispute Resolution Announced',
                'content' => 'The annual conference will feature keynote speakers and workshops aimed at improving dispute resolution practices.',
                'author' => 'Sarah Davis',
                'image_url' => 'https://picsum.photos/200/300?random=5', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Case Study: Successful Mediation in Business Disputes',
                'content' => 'A recent case study highlights the effectiveness of mediation in resolving disputes between businesses.',
                'author' => 'Chris Wilson',
                'image_url' => 'https://picsum.photos/200/300?random=6', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'The Role of Technology in Modern Dispute Resolution',
                'content' => 'Exploring how technology is reshaping the landscape of dispute resolution and conflict management.',
                'author' => 'Jessica Taylor',
                'image_url' => 'https://picsum.photos/200/300?random=7', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'New Research on Family Mediation Released',
                'content' => 'Recent research findings shed light on the effectiveness of family mediation in resolving conflicts.',
                'author' => 'David Lee',
                'image_url' => 'https://picsum.photos/200/300?random=8', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Expert Panel Discusses Future of Dispute Resolution',
                'content' => 'A panel of experts gathered to discuss trends and predictions for the future of dispute resolution.',
                'author' => 'Laura Martinez',
                'image_url' => 'https://picsum.photos/200/300?random=9', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Success Stories from the Dispute Resolution Community',
                'content' => 'Read about inspiring success stories from professionals in the dispute resolution field.',
                'author' => 'Robert Anderson',
                'image_url' => 'https://picsum.photos/200/300?random=10', // Random image
            ],
            [
                'category'=>'clause',
                'title' => 'Macao',
                'intro'=>'Any dispute, controversy or claim arising out of or relating to this contract, shall be settled by conciliation in MACAO S.A.R. at World Trade Center Macau Arbitration ...',
                'content' => 'Any dispute, controversy or claim arising out of or relating to this contract, shall be settled by conciliation in MACAO S.A.R. at World Trade Center Macau Arbitration Center and in accordance with its Internal Regulations. If the said dispute, controversy or claim could not be resolved by conciliation, with the parties’ will, it can be settled through the arbitration process.',
                'author' => 'Robert Anderson'
            ],
            [
                'category'=>'clause',
                'title' => 'Hong Kong',
                'intro'=>'“Any dispute or difference arising out of or in connection with this contract shall first be referred to mediation at Hong Kong International Arbitration Centre (HKIAC) ...',
                'content' => '“Any dispute or difference arising out of or in connection with this contract shall first be referred to mediation at Hong Kong International Arbitration Centre (HKIAC) and in accordance with its then current Mediation Rules. If the mediation is abandoned by the mediator or is otherwise concluded without the dispute or difference being resolved, then such dispute or difference shall be referred to and determined by arbitration at HKIAC and in accordance with its Domestic Arbitration Rules”.',
                'author' => 'Robert Anderson'
            ],
            [
                'category'=>'clause',
                'title' => 'Singapore',
                'intro'=>'Any dispute arising out of or in connection with this agreement must be submitted for mediation at the Singapore Mediation Centre (SMC) in accordance with SMC’s ...',
                'content' => 'Any dispute arising out of or in connection with this agreement must be submitted for mediation at the Singapore Mediation Centre (SMC) in accordance with SMC’s Mediation Procedure in force for the time being. Either/any party may submit a request to mediate to SMC upon which the other party will be bound to participate in the mediation within [45 days] thereof. Every party to the mediation must be represented by [senior executive personnel, of at least the seniority of a Head of Department] or its equivalent, with authority to negotiate and settle the dispute. Unless otherwise agreed by the parties, the Mediator(s) will be appointed by SMC. The mediation will take place in Singapore in the [English] language and the parties agree to be bound by any settlement agreement reached.',
                'author' => 'Robert Anderson'
            ],
            [
                'category'=>'clause',
                'title' => 'UK',
                'intro'=>'Any dispute arising out of or in connection with this contract shall, at first instance, be referred to a mediator for resolution. The parties shall attempt to agree upon the  ...',
                'content' => 'Suggested Arbitration & Mediation Clause<br>
                    Any dispute arising out of or in connection with this contract shall, at first instance, be referred to a mediator for resolution. The parties shall attempt to agree upon the appointment of a mediator, upon receipt, by either of them, of a written notice to concur in such appointment. Should the parties fail to agree within fourteen days, either party, upon giving written notice, may apply to the President or the Vice President, for the time being, of the Chartered Institute of Arbitrators, for the appointment of a mediator.<br>
                    Should the mediation fail, in whole or in part, either party may, upon giving written notice, and within twenty eight days thereof, apply to the President or the Vice President, for the time being, of the Chartered Institute of Arbitrators, for the appointment of a single arbitrator, for final resolution. The arbitrator shall have no connection with the mediator or the mediation proceedings, unless both parties have consented in writing. The arbitration shall be governed by both the Arbitration Act 1996 and the Controlled Cost Rules of the Chartered Institute of Arbitrators (2014 Edition), or any amendments thereof, which Rules are deemed to be incorporated by reference into this clause. The seat of the arbitration shall be England and Wales.
                ',
                'author' => 'Robert Anderson'
            ],
            [
                'category'=>'clause',
                'title' => 'CEDR',
                'intro'=>'‘If any dispute arises in connection with this agreement, the parties agree to enter  ...',
                'content' => '‘If any dispute arises in connection with this agreement, the parties agree to enter into mediation in good faith to settle such a dispute and will do so in accordance with the CEDR Model Mediation Procedure. Unless otherwise agreed between the parties within 14 days of notice of the dispute, the mediator will be nominated by CEDR.’',
                'author' => 'Robert Anderson'
            ],
            [
                'category'=>'clause',
                'title' => 'USA',
                'intro'=>'If a dispute arises out of or relates to this contract, or the breach thereof, and if the dispute cannot be settled through negotiation, the parties agree first to try in good  ...',
                'content' => 'If a dispute arises out of or relates to this contract, or the breach thereof, and if the dispute cannot be settled through negotiation, the parties agree first to try in good faith to settle the dispute by mediation administered by the American Arbitration Association under its Commercial Mediation Procedures before resorting to arbitration, litigation, or some other dispute resolution procedure.<br>
                    The parties hereby submit the following dispute to mediation administered by the American Arbitration Association under its Commercial Mediation Procedures [the clause may also provide for the qualifications of the mediator(s), the method for allocating fees and expenses, the locale of meetings, time limits, or any other item of concern to the parties.
                ',
                'author' => 'Robert Anderson'
            ],
        ];

        // Insert news data into the database using the News model
        foreach ($articles as $article) {
            // Create the news article
            $newsItem = Article::create([
                'category'=>$article['category'],
                'title' => $article['title'],
                'content' => $article['content'],
                'author' => $article['author'],
                'published_at' => now(),
            ]);

            // Retry logic for attaching media
            $maxRetries = 3;
            $attempts = 0;
            while ($attempts < $maxRetries) {
                if(!array_key_exists('image_url',$article)){
                    break;
                };
                $response = Http::get($article['image_url']);
                if ($response->successful()) {
                    // Attach the media from the URL directly to the news article
                    $newsItem->addMediaFromUrl($article['image_url'])
                        ->toMediaCollection('thumbnail');
                    break; // Exit the loop if successful
                }
                $attempts++;
                sleep(1); // Wait for 1 second before retrying
            }

            if ($attempts == $maxRetries) {
                // Log an error or handle the failure case
                \Log::error("Failed to attach media for article: " . $article['title']);
            }
        }

    }
}