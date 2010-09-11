/*
    A modified barnes hutt tree for collision detection.
    Copyright (C) 2009 Alex Brandt

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

*/

#include <limits>
#include <boost/tuple/tuple.hpp>
#include <iostream>
#include <boost/lexical_cast.hpp>
#include <gsl/gsl_math.h>
#include <cmath>
#include <gsl/gsl_cblas.h>
#include <cassert>

#include "../../include/map/octtree.h"
#include "../../include/output.h"

namespace Maps
{
    OctTree::OctTree(const std::vector<std::vector<double> > & region, const double & distance, const bool & verbose, const bool & debug)
            : root(NULL), debug(debug), verbose(verbose), dist(distance)
    {
        using namespace boost;

        /**
         * @todo Implement the template type's constructor.
         */
        Sprites::Sprite sprite(0, 0, 0, 0);
        root = this->addPoint(point);
        root->Region = region;
    }

    void OctTree::Insert(const Point & point)
    {
        this->insert(point, root);
    }

    std::string OctTree::print(Node * node)
    {
        using namespace std;
        using namespace boost;

        static int depth = -1;
        static int count = -1;

        if (node == this->root) count = -1;

        string ret;

        ret += "Depth: " + lexical_cast<string>(++depth);
        ret += " Total: " + lexical_cast<string>(++count);
        ret += " ( point: " + lexical_cast<string>(*node->CenterApproximation);
        ret += ", r: < " + lexical_cast<string>(node->Region[0][0]) + ", " + lexical_cast<string>(node->Region[0][1]) + ", " + lexical_cast<string>(node->Region[0][2]) + " >";
        ret += " :: < " + lexical_cast<string>(node->Region[1][0]) + ", " + lexical_cast<string>(node->Region[1][1]) + ", " + lexical_cast<string>(node->Region[1][2]) + " > )\n";
        for (int i = 0; i < 8; ++i) if (node->Children[i]) ret += this->print(node->Children[i]);
        --depth;

        return ret;
    }

    double OctTree::distance(size_t dim, double * k, double * l)
    {
        double ret = 0.0;

        for (unsigned int i = 0; i < dim; ++i)
            ret += std::pow(k[i] - l[i], 2);

        return std::sqrt(ret);
    }

    double OctTree::magnitude(size_t dim, double * k)
    {
        double total = 0.0;

        for (unsigned int i = 0; i < dim; ++i)
            total += std::pow(k[i], 2);

        return std::sqrt(total);
    }

    double OctTree::integrand(size_t dim, double * point, double * mass)
    {
        using namespace std;

        double *r = point; //!< The position we are calculating at.
        double *r_o = mass; //!< The position of the body.

        double rdot = cblas_ddot(dim, r, 1, r_o, 1);
#ifndef NDEBUG
        DEBUG(r[0]);
        DEBUG(r[1]);
        DEBUG(r[2]);
        DEBUG(r_o[0]);
        DEBUG(r_o[1]);
        DEBUG(r_o[2]);
        DEBUG(rdot);
#endif
        double mag_r = this->magnitude(dim, r);
        double mag_r_o = this->magnitude(dim, r_o);

        double result = 0.0;

        double terms[7] =
        {
            (1.0 / mag_r),
            (1.0 / pow(mag_r, 3)) * rdot,
            (1.0 / pow(mag_r, 5)) * ((3.0 / 2.0)*pow(rdot, 2) - (1.0 / 2.0)*pow(mag_r, 2)*pow(mag_r_o, 2)),
            (1.0 / pow(mag_r, 7)) * ((5.0 / 2.0)*pow(rdot, 3) - (3.0 / 2.0)*rdot*pow(mag_r, 2)*pow(mag_r_o, 2)),
            (1.0 / pow(mag_r, 9)) * ((35.0 / 8.0)*pow(rdot, 4) - (15.0 / 4.0)*pow(rdot, 2)*pow(mag_r, 2)*pow(mag_r_o, 2) + (3.0 / 8.0)*pow(mag_r, 4)*pow(mag_r_o, 4)),
            (1.0 / pow(mag_r, 11)) * ((63.0 / 8.0)*pow(rdot, 5) - (35.0 / 4.0)*pow(rdot, 3)*pow(mag_r, 2)*pow(mag_r_o, 2) + (15.0 / 8.0)*rdot*pow(mag_r, 4)*pow(mag_r_o, 4)),
            (1.0 / pow(mag_r, 13)) * ((231.0 / 16.0)*pow(rdot, 6) - (315.0 / 16.0)*pow(rdot, 4)*pow(mag_r, 2)*pow(mag_r_o, 2) + (105.0 / 16.0)*pow(rdot, 2)*pow(mag_r, 4)*pow(mag_r_o, 4) - (5.0 / 16.0)*pow(mag_r, 6)*pow(mag_r_o, 6))
        };

        for (int i = 0; i < 7; ++i)
            result += terms[i];

        return result;
    }

    double OctTree::calculatePotential(size_t dim, double * point, Node * n)
    {
        double ret = 0.0;
        bool opened = false;
#ifndef NDEBUG
        static int opens;
        if (n == this->root) opens = 0;
#endif

        assert(n->CenterApproximation->GetPosition().size() == dim);

        double mass[dim];
        for (unsigned int i = 0; i < dim; ++i)
            mass[i] = n->CenterApproximation->GetPosition()[i];

#ifndef NDEBUG
        DEBUG(Point(0, point[0], point[1], point[2]));
        DEBUG(*n->CenterApproximation);
        DEBUG((3.0 / 4.0)*std::pow(this->dist, 2));
        DEBUG(this->distance(dim, point, mass));
#endif

        if (this->distance(dim, point, mass) < (3.0 / 4.0)*std::pow(this->dist, 2)) //!< Open the node.
        {
            for (int i = 0; i < 8; ++i)
            {
#ifndef NDEBUG
                DEBUG(n->Children[i]);
#endif
                if (n->Children[i])
                {
                    ret += this->calculatePotential(dim, point, n->Children[i]);
                    opened = true;
#ifndef NDEBUG
                    DEBUG(++opens);
#endif
                }
            }
        }
        if (!opened) ret = n->CenterApproximation->GetMass() * (1.0 / this->distance(dim, point, mass));
        /** @note Future use? this->integrand(dim, point, mass) */
#ifndef NDEBUG
        if (!opened) VERBOSE("!opened: " + boost::lexical_cast<std::string>(Point(0, point[0], point[1], point[2])));
#endif

#ifndef NDEBUG
        DEBUG(opened);
        DEBUG(ret);
#endif

        return ret;
    }

    std::vector<std::vector<std::vector<double> > > OctTree::CalculatePotential(std::vector<std::vector<double *> > & region, const int & steps)
    {
        std::vector<std::vector<std::vector<double> > > potential;
        std::vector<std::vector<double> > inner;
        std::vector<double> innermost;

#ifndef NDEBUG
        DEBUG("\n" + this->print(this->root));
#endif

        for (int i = 0; i < steps + 1; ++i)
            innermost.push_back(0.0);
        for (int i = 0; i < steps + 1; ++i)
            inner.push_back(innermost);
        for (int i = 0; i < steps + 1; ++i)
            potential.push_back(inner);

        double lowers[3], uppers[3], step_size[3], current[3];
        for (int i = 0; i < 3; ++i)
        {
            lowers[i] = (region[0][i]) ? *region[0][i] : root->Region[0][i];
            uppers[i] = (region[1][i]) ? *region[1][i] : root->Region[1][i];
            step_size[i] = (uppers[i] - lowers[i]) / steps;
            current[i] = lowers[i];
#ifndef NDEBUG
            DEBUG(lowers[i]);
            DEBUG(uppers[i]);
            DEBUG(step_size[i]);
            DEBUG(steps);
            DEBUG(current[i]);
#endif
        }

        for (int i = 0; i < steps + 1; ++i, current[0] += step_size[0])
            for (int j = 0; j < steps + 1; ++j, current[1] += step_size[1])
                for (int k = 0; k < steps + 1; ++k, current[2] += step_size[2])
                {
                    /**
                    * \phi(\vec(r)) = M_i * 1/(|current - point_i|)
                    */
#ifndef NDEBUG
                    DEBUG(Point(0, current[0], current[1], current[2]));
#endif
                    potential[i][j][k] = -this->calculatePotential(3, current, this->root);
#ifndef NDEBUG
                    DEBUG(Point(0, i, j, k));
                    DEBUG(potential[i][j][k]);
#endif
                }

        return potential;
    }

    double OctTree::volume(const std::vector<std::vector<double> > & region)
    {
        return (region[1][0] - region[0][0])*(region[1][1] - region[0][1])*(region[1][2] - region[0][2]);
    }

    void OctTree::insert(const Point & point, Node * n)
    {
        using namespace boost;

#ifndef NDEBUG
        DEBUG(n);
        DEBUG(n->ChildCount);
#endif

        for (int i = 0; i < 8; ++i)
        {
            if (this->contained(point, this->subRegion(n->Region, i)))
            {
                if (n->Children[i])
                {
                    VERBOSE("Recursive Insert of a point! " + lexical_cast<std::string>(point));
                    this->insert(point, n->Children[i]);
                    VERBOSE("End of recursive call!");
                }
                else
                {
                    VERBOSE("Inserting a point locally! " + lexical_cast<std::string>(point));
                    n->Children[i] = this->addPoint(point);
                    n->Children[i]->Region = this->subRegion(n->Region, i);
#ifndef NDEBUG
                    DEBUG(n->ChildCount);
                    DEBUG(n->CenterApproximation->GetMass());
#endif
                    if (n->ChildCount++ == 0 && n->CenterApproximation->GetMass() != 0)
                    {
                        VERBOSE("Inserting self into self!");
                        this->insert(*n->CenterApproximation, n);
                    }
                }
                break;
            }
        }

#ifndef NDEBUG
        DEBUG(*n->CenterApproximation);
#endif

        double mass = 0.0;
        for (int i = 0; i < 8; ++i)
            mass += (n->Children[i]) ? n->Children[i]->CenterApproximation->GetMass() : 0.0;
        n->CenterApproximation->SetMass(mass);

        double coordinates[3];
        for (int i = 0; i < 3; ++i)
        {
            coordinates[i] = 0;
            for (int j = 0; j < 8; ++j)
            {
                if (!n->Children[j]) continue;
                double tmp = n->Children[j]->CenterApproximation->GetPosition()[i];
                coordinates[i] += n->Children[j]->CenterApproximation->GetMass() * tmp;
            }
            coordinates[i] /= n->CenterApproximation->GetMass();
        }
        n->CenterApproximation->SetPosition(coordinates[0], coordinates[1], coordinates[2]);

#ifndef NDEBUG
        DEBUG(*n->CenterApproximation);
        DEBUG('\n' + this->print(this->root));
#endif
    }

    std::vector<std::vector<double> > OctTree::subRegion(const std::vector<std::vector<double> > & region, const int & i)
    {
        using namespace boost;

        /**
        * The regions are in terms of positive and negative components after zeroing at the center of the region:
        * 0 -> (-,-,-)
        * 1 -> (-,-,+)
        * 2 -> (-,+,-)
        * 3 -> (-,+,+)
        * 4 -> (+,-,-)
        * 5 -> (+,-,+)
        * 6 -> (+,+,-)
        * 7 -> (+,+,+)
        */

        std::vector<double> center = this->center(region);

        std::vector<std::vector<double> > ret;
        std::vector<double> point;
        ret.push_back(point);
        ret.push_back(point);

        switch (i)
        {
            case 0:
                ret[0] = region[0];
                ret[1] = center;
                break;
            case 1:
                ret[0] = region[0];
                ret[1] = center;
                ret[0][2] = center[2];
                ret[1][2] = region[1][2];
                break;
            case 2:
                ret[0] = region[0];
                ret[1] = center;
                ret[0][1] = center[1];
                ret[1][1] = region[1][1];
                break;
            case 3:
                ret[0] = center;
                ret[1] = region[1];
                ret[0][0] = region[0][0];
                ret[1][0] = center[0];
                break;
            case 4:
                ret[0] = region[0];
                ret[1] = center;
                ret[0][0] = center[0];
                ret[1][0] = region[1][0];
                break;
            case 5:
                ret[0] = center;
                ret[1] = region[1];
                ret[0][1] = region[0][1];
                ret[1][1] = center[1];
                break;
            case 6:
                ret[0] = center;
                ret[1] = region[1];
                ret[0][2] = region[0][2];
                ret[1][2] = center[2];
                break;
            case 7:
                ret[0] = center;
                ret[1] = region[1];
                break;
        }
        return ret;
    }

    std::vector<double> OctTree::center(const std::vector<std::vector<double> > & region)
    {
        std::vector<double> center;
        center.push_back(region[0][0] + (region[1][0] - region[0][0]) / 2);
        center.push_back(region[0][1] + (region[1][1] - region[0][1]) / 2);
        center.push_back(region[0][2] + (region[1][2] - region[0][2]) / 2);
        return center;
    }

    OctTree::Node * OctTree::addPoint(const Point & point)
    {
        Node * n = new Node();
        n->CenterApproximation = new Point(point);
        n->ChildCount = 0;
        return n;
    }

    bool OctTree::contained(const Point & point, const std::vector<std::vector<double> > & region)
    {
        using namespace boost;

        double tmp;

        /**
        * @note Why does including either boundary change the results?
        */
        for (int i = 0; i < 3; ++i)
            if ((tmp = point.GetPosition()[i]) < region[0][i] || tmp > region[1][i])
                return false;
        return true;
    }
}
// kate: indent-mode cstyle; space-indent on; indent-width 4;
